<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Geo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('province', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('provinceID')->unsigned()->unique();
            $table->string('province');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('city', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('cityID')->unsigned()->unique();
            $table->string('city');
            $table->integer('fatherID')->unsigned()->index();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('area', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('areaID')->unsigned()->unique();
            $table->string('area');
            $table->integer('fatherID')->unsigned()->index();
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
        Schema::drop('province');
        Schema::drop('city');
        Schema::drop('area');
    }
}
