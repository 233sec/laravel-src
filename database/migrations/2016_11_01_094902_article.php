<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Article extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title', 128)->default('')->comment      = '文章标题';
            $table->string('cover_img', 128)->default('')->comment  = '封面图';
            $table->string('content', 8192)->default('')->comment   = '内容';
            $table->string('slug', 64)->default('')->comment        = '值';
            $table->string('tags', 256)->default('')->comment       = '标签';
            $table->integer('type')->default('1')->comment       = '类型 1公告 2文章';
            $table->integer('status')->default('0')->comment     = '状态 0草稿 1已发布 2已置顶';
            $table->timestamps();
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
        Schema::drop('articles');
    }
}
