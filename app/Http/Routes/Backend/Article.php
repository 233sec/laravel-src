<?php

Route::group([
    'middleware' => 'access.routeNeedsPermission:manage-articles',
], function() {

Route::get('article/article/list',
    'ArticleController@index')->name('admin.article.list');

Route::get('article/article/search',
    'ArticleController@search')->name('admin.article.search');

Route::get('article/article/detail/{article_id}',
    'ArticleController@detail')->name('admin.article.detail');

Route::post('article/article/detail/{article_id}',
    'ArticleController@detail')->name('admin.article.detail');

Route::get('article/article/create',
    'ArticleController@create')->name('admin.article.create');

Route::post('article/article/create',
    'ArticleController@create')->name('admin.article.create');

});
