<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Modules\Admin\Controllers', 'as' => 'admin.'], function () {
    Route::get('/admin', ['uses' => 'AdminController@index']);
});
