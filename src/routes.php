<?php

//Page
Route::get('page/{slug}', 'CeddyG\ClaraPageBuilder\Http\Controllers\PageController@show');

Route::group(['prefix' => config('clara.page.route.web.prefix'), 'middleware' => config('clara.page.route.web.middleware')], function()
{
    Route::resource('page', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageController', ['names' => 'admin.page']);
});

Route::group(['prefix' => config('clara.page.route.api.prefix'), 'middleware' => config('clara.page.route.api.middleware')], function()
{
    Route::get('page/index/ajax', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageController@indexAjax')->name('admin.page.index.ajax');
	Route::get('page/select/ajax', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageController@selectAjax')->name('admin.page.select.ajax');
});

//Category
Route::group(['prefix' => config('clara.page-category.route.web.prefix'), 'middleware' => config('clara.page-category.route.web.middleware')], function()
{
    Route::resource('page-category', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageCategoryController', ['names' => 'admin.page-category']);
});

Route::group(['prefix' => config('clara.page-category.route.api.prefix'), 'middleware' => config('clara.page-category.route.api.middleware')], function()
{
    Route::get('page-category/index/ajax', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageCategoryController@indexAjax')->name('admin.page-category.index.ajax');
	Route::get('page-category/select/ajax', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageCategoryController@selectAjax')->name('admin.page-category.select.ajax');
});