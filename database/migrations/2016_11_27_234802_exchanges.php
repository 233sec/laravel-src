<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Exchanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('goods_id')->index()->comment = '商品ID';
            $table->integer('user_id')->index()->comment = '用户ID';
            $table->integer('type')->index()->comment = '商品类型: 1.实物(需要收货地址)  2.虚拟物品(无需收货地址)';
            $table->decimal('cost', 10, 2)->index()->comment = '商品原价/成本';
            $table->decimal('coin', 10, 2)->index()->comment = '商品价格(安全币)';
            $table->string('receive_address')->nullable()->comment = '收货地址';
            $table->string('receive_phone')->nullable()->comment = '收货手机号';
            $table->string('receive_name')->nullable()->comment = '收货人';
            $table->string('express_vendor')->nullable()->comment = '快递公司';
            $table->string('express_sn')->nullable()->comment = '快递单号';
            $table->integer('status')->index()->comment = '状态: -1 已拒绝 0 审核中 1 已发货 2 完成';
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
        Schema::drop('exchanges');
    }
}
