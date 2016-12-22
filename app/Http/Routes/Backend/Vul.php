<?php

Route::group([
    'middleware' => 'access.routeNeedsPermission:manage-vuls',
], function() {

Route::get('vul/create',
    'vulController@create')->name('admin.vul.create');

Route::get('vul/search',
    'vulController@search')->name('admin.vul.search');

Route::get('vul/list',
    'vulController@index')->name('admin.vul');

Route::get('vul/detail/{vul_id}',
    'vulController@detail')->name('admin.vul.detail');

Route::get('vul/detail/{vul_id}/comments',
    'vulController@searchComments')->name('admin.vul.comments');

Route::get('vul/detail/{vul_id}/{action}',
    'vulController@detail')->name('admin.vul.edit');

Route::post('vul/create',
    'vulController@create')->name('admin.vul.create');

Route::post('vul/detail/{vul_id}/edit',
    'vulController@detail')->name('admin.vul.edit');

Route::get('vul/detail/{vul_id}/{action}',
    'vulController@detail')->name('admin.vul.edit');

Route::post('vul/publish/preview',
    'vulController@publishPreview')->name('admin.vul.publish.preview');

Route::post('vul/detail/{vul_id}',
    'vulController@detail')->name('admin.vul.detail');

Route::post('vul/publish/submit',
    'vulController@publish')->name('admin.vul.publish.submit');

Route::post('institutionmanage-viewer/upload_institution_file', 'InstitutionManageController@uploadInstitutionFile')->name('admin.institutionmanage_upload_institution_file');
});
