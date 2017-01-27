<?php

namespace App\Http\Controllers\Backend;

use DB;
use Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatatablesX;
use Yajra\Datatables\Facades\Datatables;
use Tsssec\Editable\Editable;

/**
 * Class ExchangeController
 * @package App\Http\Controllers\Backend
 */
class ExchangeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function createGoods()
    {
        $goods_detail = new Editable();
        return
        $goods_detail->options([
            'primary_key' => 'id',
            'i18n' => [
                'id' => 'ID',
                'title' => 'NAME',
                'goods_img' => '图片',
                'type' =>  '商品类型',
                'cost' =>  '商品成本',
                'coin' =>  ' 商品价格',
                'stock' =>  '商品库存',
                'stock_sum' =>  '商品库存',
                'created_at' => '创建于'
            ]
        ])->insertTo(
            DB::table('goods')
        )->ready(function($goods_detail){
            return view('backend.exchange.detail_goods', ['goods_detail' => $goods_detail]);
        });
    }

    /**
     * @return \Illuminate\View\View
     */
    public function detailGoods($goods_id)
    {
        $goods_detail = new Editable();
        return
        $goods_detail->options([
            'primary_key' => 'id',
            'i18n' => [
                'id' => 'ID',
                'title' => 'NAME',
                'goods_img' => '图片',
                'type' =>  '商品类型',
                'cost' =>  '商品成本',
                'coin' =>  ' 商品价格',
                'stock' =>  '商品库存',
                'stock_sum' =>  '商品库存',
                'created_at' => '创建于'
            ]
        ])->queryBuilder(
            DB::table('goods')
            ->select([
                'id',
                'title',
                'goods_img',
                'type',
                'cost',
                'coin',
                'stock',
                'stock_sum',
                'created_at'
            ])
            ->where(['id'=>$goods_id])

        )->ready(function($goods_detail){
            return view('backend.exchange.detail_goods', ['goods_detail' => $goods_detail]);
        });
    }

    /**
     * @return \Illuminate\View\View
     */
    public function listGoods()
    {
        return view('backend.exchange.list_goods');
    }

    /**
     * @return Response
     */
    public function searchGoods()
    {

        return DatatablesX::queryBuilder(
            DB::table('goods')
                ->select([
                    'id',
                    'type',
                    'title',
                    'goods_img',
                    'cost',
                    'coin',
                    'stock',
                    'stock_sum',
                    'created_at'
                ])
        )->make(true);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function listExchangeLog()
    {
        return view('backend.exchange.list_exchangelog');
    }

    /**
     * @return Response
     */
    public function searchExchangeLog()
    {
        return DatatablesX::queryBuilder(DB::table('exchanges')
            ->join('users', 'users.id', '=', 'exchanges.user_id', 'left')
            ->select([
                'exchanges.id',
                'exchanges.title',
                'exchanges.goods_id',
                'exchanges.user_id',
                'users.name as user_name',
                'exchanges.type',
                'exchanges.cost',
                'exchanges.coin',
                'exchanges.receive_address',
                'exchanges.receive_phone',
                'exchanges.receive_name',
                'exchanges.express_vendor',
                'exchanges.express_sn',
                'exchanges.status',
                'exchanges.created_at'
            ])
        )->addColumn('actions', '')->make(true);
    }

    /**
     * @return \Response
     */
    public function detailExchangeLog($exchange_id)
    {
        $exchange_detail = new Editable();

        return
        $exchange_detail->options([
            'primary_key' => 'id',
            'i18n' => [
                'lengend_1'     => '文章/公告編輯',
                'id'            => 'ID',
                'title'         => '订单名称',
                'created_at'    => '创建时间',
                'status'        => '状态',
            ]
        ])->queryBuilder(
            DB::table('exchanges')
            ->where(['id' => $exchange_id])
        )->ready(function($exchange_detail){
            return view('backend.exchange.detail', ['exchange_detail' => $exchange_detail]);
        });

    }
}
