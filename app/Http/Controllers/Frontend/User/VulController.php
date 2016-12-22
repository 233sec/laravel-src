<?php
namespace App\Http\Controllers\Frontend\User;

use DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Repositories\Frontend\Access\User\UserRepositoryContract;
use Response;
use Yajra\Datatables\Facades\Datatables;
use Tsssec\Editable\Editable;
use voku\helper\AntiXSS;

/**
 * Class vulController
 * @package App\Http\Controllers\Backend
 */
class VulController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.user.vul.list');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try{
            $vul_detail = new Editable();
            return
            $vul_detail->options([
                'instance' => 'vul',
                'primary_key' => 'id',
                'i18n' => [
                    'lengend_1'     => '漏洞审核',
                    'id'            => 'ID',
                    'uuid'          => '漏洞代号',
                    'title'         => '标题',
                    'category'      => '类型',
                    'emergency'     => '危害级别',
                    'reward'        => '安全币',
                    'credit'        => '贡献度',
                    'content'       => '内容',
                    'status'        => '状态',
                    'created_at'    => '创建时间',
                    'updated_at'    => '修改时间',
                    'deleted_at'    => '删除时间',
                ],
                'columns_protected' => ['id', 'status', 'reward', 'credit', 'created_at', 'updated_at', 'deleted_at'],
                'edit' => true
            ])
            ->insertTo(DB::table('vuls'))
            ->onsubmit(
                function($data){
                    $antiXss = new AntiXSS();
                    $user_id = auth()->user()->getAuthIdentifier();
                    if( !$user_id ) throw new \Exception('USER_NOT_LOGIN', -998);
                    $return = [];

                    $data['title']          = $antiXss->xss_clean($data['title']);
                    $data['content']        = $antiXss->xss_clean($data['content']);
                    $data['user_id']        = $user_id;
                    $data['created_at']     = date('Y/m/d H:i:s');
                    $data['updated_at']     = null;
                    $data['status']         = 0;
                    $data['reward']         = 0;
                    $data['credit']         = 0;
                    $data['uuid']           = 'VD'.date('Y').'-'.strtoupper(substr(base_convert(mt_rand(100000000,999999999), 10, 36), 1, 5));
                    $data['category']       = (int) $data['category'];
                    $data['emergency']      = (int) $data['emergency'];

                    $return['title']        = $data['title'];
                    $return['content']      = $data['content'];
                    $return['created_at']   = $data['created_at'];
                    $return['status']       = $data['status'];
                    $return['reward']       = $data['reward'];
                    $return['credit']       = $data['credit'];
                    $return['uuid']         = $data['uuid'];
                    $return['user_id']      = $data['user_id'];
                    $return['category']     = $data['category'];
                    $return['emergency']    = $data['emergency'];

                    if( !$return['title'] ) throw new \Exception('title IS REQUIRED', -997);
                    if( !$return['content'] ) throw new \Exception('content IS REQUIRED', -997);
                    if( !$return['category'] ) throw new \Exception('category IS REQUIRED', -997);
                    if( !$return['emergency'] ) throw new \Exception('emergency IS REQUIRED', -997);
                    return $return;
                }
            )
            ->ready(function($vul_detail){
                return view('frontend.user.vul.detail', ['vul_detail' => $vul_detail, 'vul_id' => 0]);
            });
        }catch(\Exception $e){
            return \Response::json([
                'head' => [
                    'statusCode' => $e->getCode(),
                    'note' => $e->getMessage()
                ],
                'body' => new \stdClass()
            ]);
        }
    }

    /**
     * @return \Illuminate\View\View
     */
    public function detail($vul_id, $action = 'view')
    {
        $vul_detail = new Editable();
        $vul_detail->options([
            'instance' => 'vul',
            'primary_key' => 'id',
            'i18n' => [
                'uuid'          => '漏洞代号',
                'title'         => '标题',
                'id'            => 'ID',
                'category'      => '类型',
                'emergency'     => '危害级别',
                'reward'        => '安全币',
                'credit'        => '贡献度',
                'content'       => '内容',
                'status'        => '状态',
                'created_at'    => '创建时间',
                'updated_at'    => '修改时间',
            ],
            'edit' => ($action == 'edit')
        ])
        ->queryBuilder(
            DB::table('vuls')
            ->select(['vuls.id', 'vuls.title', 'vuls.uuid', 'vuls.content', 'vuls.category', 'vuls.reward', 'vuls.credit',
            'vuls.emergency', 'vuls.status', 'vuls.created_at', 'vuls.updated_at'])
            ->where([ 'vuls.id' => $vul_id ])
        );
        if ('admin.vul.detail' != \Request::route()->getName() && $_POST){
            $vul_detail->onsubmit(
                function($data){
                    return []; # 屏蔽用户修改漏洞
                }
            );
        } else {
            $vul_detail->ready();
        }

        # 创建评论的 editable
        return (new Editable())->options([
            'instance' => 'comment',
            'primary_key' => 'id',
            'i18n' => [
                'content' => '留言内容'
            ]
        ])
        ->insertTo(DB::table('vuls_comments'))
        ->onsubmit(function($data) use($vul_id) {
            $antiXss = new AntiXSS();
            $data['content'] = $antiXss->xss_clean($data['content']);
            $data['vul_id'] = $vul_id;
            $data['user_id'] = auth()->user()->getAuthIdentifier();
            $data['role_id'] = 0;
            return $data;
          })
          ->ready(function($comment_detail) use($vul_detail, $vul_id){
              return view('frontend.user.vul.detail', ['vul_detail' => $vul_detail, 'comment_detail' => $comment_detail, 'vul_id' => $vul_id]);
          });
    }

    public function search() {
        return Datatables::queryBuilder(
            DB::table('vuls')
            ->join('users', 'users.id', '=', 'vuls.user_id', 'left')
            ->select(['vuls.id', 'vuls.title', 'vuls.uuid', 'vuls.user_id', 'vuls.content', 'vuls.category', 'vuls.reward', 'vuls.credit',
                'vuls.emergency', 'vuls.status', 'vuls.created_at', 'vuls.updated_at', 'vuls.deleted_at',
                'users.name', 'users.email'])
            ->where(['vuls.user_id' => auth()->user()->getAuthIdentifier()])
            ->orderBy('vuls.id', 'DESC')
        )
        ->filterColumn('id', function($query, $keyword) {
            $query->whereRaw("`vul`.`id`=?", ["'{$keyword}'"]);
        })
        ->whitelist(['vuls.id'])
        ->make(true);
    }

    public function searchComments($vul_id) {
        return Datatables::queryBuilder(
            DB::table('vuls_comments')
            ->join('users', 'users.id', '=', 'vuls_comments.user_id', 'left')
            ->join('vuls', 'vuls.id', '=', 'vuls_comments.vul_id', 'left')
            ->select(['vuls_comments.id', 'vuls_comments.user_id', 'users.name', 'vuls_comments.role_id', 'vuls_comments.created_at', 'vuls_comments.content'])
            ->where(['vul_id' => $vul_id, 'vuls.user_id' => auth()->user()->getAuthIdentifier()])
            ->orderBy('vuls_comments.id','desc')
        )
        ->whitelist(['vuls_comments.id'])
        ->make(true);
    }
}
