<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Modules\Admin\Controllers')
    ->name('admin.')
    ->group(function () {
        Route::get('/admin', ['uses' => 'AdminController@index'])->name('index');
});
