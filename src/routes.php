<?php

//Page
Route::get('page/{slug}', 'CeddyG\ClaraPageBuilder\Http\Controllers\PageController@show')
    ->middleware(config('clara.page.route.web.middleware'));

Route::group(['prefix' => config('clara.page.route.web-admin.prefix'), 'middleware' => config('clara.page.route.web-admin.middleware')], function()
{
    Route::resource('page', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageController', ['names' => 'admin.page']);
});

Route::group(['prefix' => config('clara.page.route.api.prefix'), 'middleware' => config('clara.page.route.api.middleware')], function()
{
    Route::get('page/index', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageController@indexAjax')->name('api.admin.page.index');
	Route::get('page/select', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageController@selectAjax')->name('api.admin.page.select');
	Route::get('page/select-template', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageController@selectTemplateAjax')->name('api.admin.page.select-template');
	Route::get('page/select-template/{iIdTemplate}', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageController@showTemplateAjax')->name('api.admin.page.select-template.show');
});

//Category
Route::group(['prefix' => config('clara.page-category.route.web.prefix'), 'middleware' => config('clara.page-category.route.web.middleware')], function()
{
    Route::resource('page-category', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageCategoryController', ['names' => 'admin.page-category']);
});

Route::group(['prefix' => config('clara.page-category.route.api.prefix'), 'middleware' => config('clara.page-category.route.api.middleware')], function()
{
    Route::get('page-category/index', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageCategoryController@indexAjax')->name('api.admin.page-category.index');
	Route::get('page-category/select', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageCategoryController@selectAjax')->name('api.admin.page-category.select');
});