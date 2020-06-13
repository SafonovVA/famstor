<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');                       // =
Route::get('/', fn() => view('welcome'));             // =

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('redirect', fn() => redirect()->to('users'));

//Route::get('/', 'WelcomeController@index');

Route::get('tasks', 'TasksController@index');
Route::get('tasks/create', 'TasksController@create');
Route::post('tasks', 'TasksController@store');

Route::name('users.')
    ->prefix('users')
    ->namespace('Users')
    //->middleware(['auth:api', 'throttle:12,5'])
    ->group(function() {
        Route::get('{id?}', 'UsersController@index')
            ->where('id', '[0-9]+')->name('index');
        Route::get('{user}', 'UsersController@view')
            ->where(['user' => '[A-Za-z]+'])->name('view');

        Route::get('{id}/{some}', 'UsersController@some')
            ->where(['id' => '[0-9]+', 'some' => '[A-Za-z]+'])->name('some');
    });

Route::fallback(fn() => redirect()->refresh());
//Route::fallback(fn() => redirect()->refresh());
//Route::fallback(fn() => redirect()->home());
//Route::fallback(fn() => redirect()->back());
//Route::fallback(fn() => redirect('/'));
//Route::fallback(fn() => redirect()->to('/'));
//Route::fallback(fn() => redirect()->route('users.view', ['user' => 'Bitch']));



/*Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], fn() =>
    Route::resource('posts', 'PostController')->names('blog.posts')
);

//Route::resource('rest', 'RestTestController')->names('restTest');

$groupData = [
    'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog'
];

// Admin
Route::group($groupData, function () {
    $methods = ['index', 'edit', 'store', 'update', 'create'];
    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');
});*/
