<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('uuid')->unique();
            $table->integer('user_id')->index()->comment = '提交人ID';
            $table->text('content')->nullable()->comment = '漏洞内容';
            $table->integer('category')->index()->comment = '类型 1 XSS 2 CSRF 3 LOGIC 4 CRYPTOR 5 DECOMPILER 6 INFOLEAKS 7 LOGLEAKS 8 REMOTE EXEC';
            $table->integer('emergency')->index()->comment = '级别: 0 无危害 1 低危 2 中危 3 高危 4 严重';
            $table->integer('status')->index()->comment = '状态: -1 declined 0 pending 1 confirmed 2 fixing 3 rechecking 4 done';
            $table->integer('reward')->index()->comment = '奖励: 安全币';
            $table->integer('credit')->index()->comment = '奖励: 贡献度';
            $table->timestamp('created_at')->index()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
            $table->softDeletes();
        });
        Schema::create('vuls_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vul_id')->index()->comment = '漏洞ID';
            $table->integer('user_id')->index()->comment = '提交人ID';
            $table->integer('role_id')->index()->comment = '提交人角色';
            $table->text('content')->nullable()->comment = '留言内容';
            $table->timestamp('created_at')->index()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vuls');
        Schema::drop('vuls_comments');
    }
}
