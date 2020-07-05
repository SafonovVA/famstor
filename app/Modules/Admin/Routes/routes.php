<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Modules\Admin\Controllers')
    ->name('admin.')
    ->middleware(['web', 'artisan'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('roles', 'AuthorizationController@getAllRoles');
        Route::post('roles/create', 'AuthorizationController@addRole');
        Route::post('roles/delete', 'AuthorizationController@removeRole');
        Route::get('roles/{role}/permissions', 'AuthorizationController@getPermissionsByRole');
        Route::get('permissions', 'AuthorizationController@getAllPermissions');
});
