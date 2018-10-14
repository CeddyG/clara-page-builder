<?php

Route::get('page/{slug}', 'CeddyG\ClaraPageBuilder\Http\Controllers\PageController@show');

Route::group(['prefix' => config('clara.page.route.prefix'), 'middleware' => config('clara.page.route.middleware')], function()
{
    Route::resource('page', 'CeddyG\ClaraPageBuilder\Http\Controllers\Admin\PageController', ['names' => 'admin.page']);
});