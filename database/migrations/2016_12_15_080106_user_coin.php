<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserCoin extends Migration
{
    /**
     *  给用户表添加安全币/贡献字段
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('access.users_table'), function ($table) {
            $table->decimal('reward', 10, 2)->after('password')->default(0)->comment = '安全币';
            $table->decimal('credit', 10, 2)->after('password')->default(0)->comment = '贡献';
            $table->string('phone', 11)->after('email')->default('')->comment = '绑定手机号';
            $table->string('address', 128)->after('phone')->default('')->comment = '地址';
            $table->string('receiver', 32)->after('address')->default('')->comment = '收货人';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('access.users_table'), function (Blueprint $table) {
            $table->dropColumn('reward');
            $table->dropColumn('credit');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('receiver');
        });
    }
}
