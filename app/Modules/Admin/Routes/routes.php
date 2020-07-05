<?php

Route::namespace('App\Modules\Admin\Controllers')
    ->name('admin.')
    ->middleware(['web', 'artisan'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'AdminController@index')->name('index');
        Route::resource('roles', 'RolesController');
        Route::resource('permissions', 'PermissionsController');
});
