<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@index')->name('home');
Route::get('/blog/post/{slug}', 'PageController@blogPostSingle')->name('blog.post.single');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'users', 'middleware' => 'editUsers'], function ($id) {
        Route::get('/edit/{user_id}', 'UserController@getEdit')->name('users.edit');
        Route::post('/edit/{user_id}', 'UserController@postEdit')->name('users.edit');
    });
    
    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', 'PostController@index')->name('posts.index');
        Route::get('/create', 'PostController@getCreate')->name('posts.create');
        Route::post('/create', 'PostController@postCreate')->name('posts.create');
        Route::get('/edit/{post_id}', 'PostController@getEdit')->name('posts.edit');
        Route::post('/edit/{post_id}', 'PostController@postEdit')->name('posts.edit');
    });
    
    Route::group(['middleware' => 'admin'], function () {
        Route::group(['prefix' => 'users'], function () {  
            Route::get('/', 'UserController@index')->name('users.index');
            Route::get('/create', 'UserController@getCreate')->name('users.create');
            Route::post('/create', 'UserController@postCreate')->name('users.create');
            Route::get('/remove/{user_id}', 'UserController@getRemove')->name('users.remove');
        });
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'CategoryController@index')->name('categories.index');
            Route::get('/create', 'CategoryController@getCreate')->name('categories.create');
            Route::post('/create', 'CategoryController@postCreate')->name('categories.create');
            Route::get('/edit/{category_id}', 'CategoryController@getEdit')->name('categories.edit');
            Route::post('/edit/{category_id}', 'CategoryController@postEdit')->name('categories.edit');
            Route::get('/remove/{category_id}', 'CategoryController@getRemove')->name('categories.remove');
        });
        Route::get('/posts/remove/{post_id}', 'PostController@getRemove')->name('posts.remove');
    });

});
