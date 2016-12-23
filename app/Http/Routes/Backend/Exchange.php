<?php

Route::group([
    'middleware' => 'access.routeNeedsPermission:manage-exchanges',
], function() {

# 积兑商品
Route::get('exchange/goods',
    'ExchangeController@listGoods')->name('admin.exchange.goods.list');

Route::get('exchange/goods/search',
    'ExchangeController@searchGoods')->name('admin.exchange.goods.search');

Route::get('exchange/goods/create',
    'ExchangeController@createGoods')->name('admin.exchange.goods.create');

Route::get('exchange/goods/detail/{goods_id}',
    'ExchangeController@detailGoods')->name('admin.exchange.goods.detail');

Route::post('exchange/goods/create',
    'ExchangeController@createGoods')->name('admin.exchange.goods.create');

Route::post('exchange/goods/detail/{goods_id}',
    'ExchangeController@detailGoods')->name('admin.exchange.goods.detail');

# 兑换记录
Route::get('exchange/exchange/log',
    'ExchangeController@listExchangeLog')->name('admin.exchange.exchange.log');

Route::get('exchange/exchange/log/search',
    'ExchangeController@searchExchangeLog')->name('admin.exchange.exchange.search');

Route::post('exchange/exchange/log/detail/{exchange_id}',
    'ExchangeController@detailExchangeLog')->name('admin.exchange.exchange.detail');

});
