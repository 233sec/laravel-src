<?php
namespace App\Http\Controllers\Frontend\User;

use DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatatablesX;
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
class ExchangeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.user.exchange.list');
    }

    public function search() {
        return DatatablesX::queryBuilder(
            DB::table('exchanges')
            ->join('goods', 'goods.id', '=', 'exchanges.goods_id', 'left')
            ->select([
                'exchanges.id', 'exchanges.title', 'exchanges.goods_id', 'exchanges.type', 'exchanges.coin',
                'exchanges.receive_address', 'exchanges.receive_phone', 'exchanges.receive_name',
                'exchanges.express_vendor', 'exchanges.express_sn', 'exchanges.status', 'exchanges.created_at',
                DB::raw('goods.title AS goods_name'), 'goods.goods_img'
            ])
            ->where(['exchanges.user_id' => auth()->user()->getAuthIdentifier()])
            ->orderBy('exchanges.id', 'DESC')
        )
        ->whitelist(['id'])
        ->make(true);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try{
            $response =
            (new Editable())->options([
                'instance' => 'vul',
                'primary_key' => 'id',
                'i18n' => [
                ],
                'edit' => true
            ])
            ->insertTo(DB::table('exchanges'))
            ->onsubmit(
                function($data){
                    # begin transaction
                    DB::beginTransaction();
                    # Lock this user to prevent concurrency
                    $user = auth()->user();

                    $user_list = DB::table('users')->where(['id'=>$user->getAuthIdentifier()]);
                    $user_list->lockForUpdate();

                    # get the id of goods, find (title/ price/ stock etc info)
                    $goods_id = $data['goods_id'] ?? 0;
                    if(0 == $goods_id) throw new \Exception('Please specific a goods_id', -1);
                    $goods_list = DB::table('goods')->where(['id'=>$goods_id]);
                    # Lock this goods to prevent concurrency
                    $goods_list->lockForUpdate();
                    $goods = $goods_list->first();

                    $coin  = $goods->coin ?? -1;
                    $stock = $goods->stock ?? -1;
                    if($coin == -1) throw new \Exception('Goods price configuration error', -2);
                    if($stock == -1) throw new \Exception('Goods stock configuration error', -3);
                    if($stock < 1) throw new \Exception('Goods stock is not enough', -4);

                    $user_id = $user->getAuthIdentifier();
                    if(!$user_id) throw new \Exception('User info error', -990);
                    # check if the user balance is enough to exchang this goods
                    if($user->reward < 0) throw new \Exception('User coin balance error', -5);
                    if($user->reward < $coin) throw new \Exception('User coint balance is not enough to exchange', -6);

                    # decrese user balance coin
                    $user->reward = bcsub($user->reward, $coin, 2);
                    # insert an exchange log -- return success, auto insert
                    # commit transaction -- return success, auto commit
                    # success
                    $do = $user->save();
                    if(!$do) throw new \Exception('Decrese user balance failed'.var_export($do, 1), -6);

                    $antiXss = new AntiXSS();
                    $data['receive_name']    = $antiXss->xss_clean($data['receive_name']);
                    $data['receive_phone']   = $antiXss->xss_clean($data['receive_phone']);
                    $data['receive_address'] = $antiXss->xss_clean($data['receive_address']);

                    if(!$data['receive_name'])      throw new \Exception('请填写收货人', -9);
                    if(!$data['receive_phone'])     throw new \Exception('请填写收货人电话', -8);
                    if(!$data['receive_address'])   throw new \Exception('请填写收货人地址', -7);

                    $return = [];
                    $return['id']       = null;
                    $return['user_id']  = $user->getAuthIdentifier();
                    $return['title']    = $goods->title;
                    $return['goods_id'] = $goods->id;
                    $return['type']     = $goods->type;
                    $return['cost']     = $goods->cost;
                    $return['coin']     = $goods->coin;
                    $return['receive_address'] = $data['receive_address'];
                    $return['receive_phone']   = $data['receive_phone'];
                    $return['receive_name']    = $data['receive_name'];
                    $return['express_vendor']  = '';
                    $return['express_sn']      = '';
                    $return['status']   = 0;
                    $return['created_at'] = date('Y-m-d H:i:s');

                    return $return;
                }
            )
            ->ready(function($vul_detail){
                return view('frontend.user.vul.detail', ['vul_detail' => $vul_detail, 'vul_id' => 0]);
            });
            echo 'xxxx';
            if(DB::getPdo()->inTransaction() == true) DB::commit();

            return $response;
        }catch(\Exception $e){
            if(DB::getPdo()->inTransaction() == true) DB::rollBack();
            return \Response::json([
                'head' => [
                    'statusCode' => $e->getCode(),
                    'note' => $e->getMessage() . '|' . $e->getLine()
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

        return view('frontend.user.vul.detail', ['vul_detail' => $vul_detail, 'vul_id' => $vul_id]);
    }
}
