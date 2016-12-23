<?php

/**
 * Frontend Controllers
 */
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('/article', 'ArticleController@index')->name('frontend.article');
Route::get('/article/list', 'ArticleController@search')->name('frontend.article.search');
Route::get('/article/detail/{article_id}', 'ArticleController@detail')->name('frontend.article.detail');
Route::get('/exchange', 'ExchangeController@index')->name('frontend.exchange');
Route::get('/exchange/list', 'ExchangeController@search')->name('frontend.exchange.search');
Route::get('/hero', 'HeroController@index')->name('frontend.hero');
Route::get('/hero/list', 'HeroController@search')->name('frontend.hero.search');

/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'prefix' => 'my/'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');

        Route::get('vul/list', 'VulController@index')->name('frontend.user.vul.list'); # 漏洞列表
        Route::get('vul/search', 'VulController@search')->name('frontend.user.vul.search'); # 漏洞列表 JSON
        Route::get('vul/create', 'VulController@create')->name('frontend.user.vul.create'); # 提交漏洞页面
        Route::get('vul/detaul/{vul_id}', 'VulController@detail')->name('frontend.user.vul.detail'); # 漏洞详情
        Route::get('vul/detaul/{vul_id}/comments', 'VulController@searchComments')->name('frontend.user.vul.comments'); # 漏洞留言 JSON
        Route::post('vul/create', 'VulController@create')->name('frontend.user.vul.create'); # 提交漏洞接口
        Route::post('vul/detaul/{vul_id}', 'VulController@detail')->name('frontend.user.vul.detail'); # 提交漏洞评论

        Route::get('exchange/list', 'ExchangeController@index')->name('frontend.user.exchange.list'); # 兑换列表
        Route::get('exchange/search', 'ExchangeController@search')->name('frontend.user.exchange.search'); # 兑换列表 JSON
        Route::get('exchange/detail/{exchange_id}', 'ExchangeController@detail')->name('frontend.user.exchange.detail'); # 兑换详情
        Route::post('exchange/create', 'ExchangeController@create')->name('frontend.user.exchange.create'); # 兑换礼品提交

        Route::post('api/file/upload', 'CommonController@upload')->name('common.file.upload');
    });
});
