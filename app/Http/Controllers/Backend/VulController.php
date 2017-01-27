<?php

namespace App\Http\Controllers\Backend;

use DB;
use Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatatablesX;
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
        return view('backend.vul.list');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $vul_detail = new Editable();
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
            'edit' => true
        ])
        ->insertTo(DB::table('vuls'))
        ->onsubmit(
            function($data){
                unset($data['id']);
                $antiXss = new AntiXSS();
                $data['content'] = $antiXss->xss_clean($data['content']);
                $data['user_id'] = auth()->user()->getAuthIdentifier();
                $data['created_at'] = date('Y/m/d H:i:s');
                $data['updated_at'] = null;
                $data['status']  = 0;
                $data['reward']  = 0;
                $data['credit']  = 0;
                $data['uuid']    = 'VD-233-'.date('Y-m-d').'-'.substr(mt_rand(100000,999999));
                $data['category']    = (int) $data['category'];
                $data['emergency']   = (int) $data['emergency'];

                $return = [];
                $return['content']      = $data['content'];
                $return['created_at']   = $data['created_at'];
                $return['status']       = $data['status'];
                $return['reward']       = $data['reward'];
                $return['credit']       = $data['credit'];
                $return['uuid']         = $data['uuid'];
                $return['user_id']      = $data['user_id'];
                $return['category']     = $data['category'];
                $return['emergency']    = $data['emergency'];
                return $return;
            }
        )
        ->ready();

        return view('frontend.user.vul.detail', ['vul_detail' => $vul_detail, 'vul_id' => 0]);
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
                'lengend_1'     => '漏洞审核',
                'id'            => 'ID',
                'uuid'          => '漏洞代号',
                'title'         => '标题',
                'category'      => '类型',
                'emergency'     => '危害级别',
                'user_id'       => '提交人ID',
                'name'          => '提交人名',
                'email'         => '提交人邮箱',
                'reward'        => '安全币',
                'credit'        => '贡献度',
                'content'       => '内容',
                'status'        => '状态',
                'created_at'    => '创建时间',
                'updated_at'    => '修改时间',
                'deleted_at'    => '删除时间',
            ],
            'edit' => ($action == 'edit')
        ])
        ->queryBuilder(
            DB::table('vuls')
            ->join('users', 'users.id', '=', 'vuls.user_id', 'left')
            ->select(['vuls.id', 'vuls.title', 'vuls.uuid', 'vuls.user_id', 'vuls.content', 'vuls.category', 'vuls.reward', 'vuls.credit',
            'vuls.emergency', 'vuls.status', 'vuls.created_at', 'vuls.updated_at', 'vuls.deleted_at',
            'users.name', 'users.email'])
            ->where([ 'vuls.id' => $vul_id ])
        );
        if ('admin.vul.detail' != \Request::route()->getName() && $_POST){
            return
            $vul_detail->onsubmit(
                function($data){
                    unset($data['user_id']);
                    unset($data['name']);

                    $antiXss = new AntiXSS();
                    $data['content'] = $antiXss->xss_clean($data['content']);
                    $data['updated_at'] = date('Y/m/d H:i:s');
                    return $data;
                }
            )->ready(function($vul_detail) use($vul_id){
                return view('backend.vul.detail', ['vul_detail' => $vul_detail, 'vul_id' => $vul_id]);
            });
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
            $data['role_id'] = auth()->user()->hasRole('manage-vuls') ? 1 : 0;
            return $data;
        })
        ->ready(function($comment_detail) use($vul_detail, $vul_id){
            return view('backend.vul.detail', ['vul_detail' => $vul_detail, 'comment_detail' => $comment_detail, 'vul_id' => $vul_id]);
        });
    }

    public function search() {
        return DatatablesX::queryBuilder(
            DB::table('vuls')
            ->join('users', 'users.id', '=', 'vuls.user_id', 'left')
            ->select(['vuls.id', 'vuls.title', 'vuls.uuid', 'vuls.user_id', 'vuls.category', 'vuls.reward', 'vuls.credit',
                'vuls.emergency', 'vuls.status', 'vuls.created_at', 'vuls.updated_at', 'vuls.deleted_at',
                'users.name', 'users.email'])
        )
        ->filterColumn('id', function($query, $keyword) {
            $query->whereRaw("`vul`.`id`=?", ["'{$keyword}'"]);
        })
        ->make(true);
    }

    public function searchComments($vul_id) {
        return DatatablesX::queryBuilder(
            DB::table('vuls_comments')
            ->join('users', 'users.id', '=', 'vuls_comments.user_id', 'left')
            ->select(['vuls_comments.id', 'vuls_comments.user_id', 'users.name',
                'vuls_comments.role_id', 'vuls_comments.created_at',
                'vuls_comments.content'])
            ->where(['vul_id' => $vul_id])
            ->orderBy('vuls_comments.id','desc')
        )
        ->make(true);
    }
}
