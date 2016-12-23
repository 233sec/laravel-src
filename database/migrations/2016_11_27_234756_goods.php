<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Goods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('goods_img');
            $table->integer('type')->index()->comment = '商品类型: 1.实物(需要收货地址)  2.虚拟物品(无需收货地址)';
            $table->decimal('cost', 10, 2)->index()->comment = '商品原价/成本';
            $table->decimal('coin', 10, 2)->index()->comment = ' 商品价格(安全币)';
            $table->integer('stock')->index()->comment = '商品库存:  真实库存 兑换一次减一次';
            $table->integer('stock_sum')->index()->comment = '商品库存: 总量 不减少';
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods');
    }
}
