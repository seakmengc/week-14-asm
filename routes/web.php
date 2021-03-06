<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/{post}', 'PostController@show')->name('posts.show');

Route::group([
    'middleware' => 'auth'
], function () {
    Route::resource('categories', 'CategoryController');
    Route::delete('categories/{category}/ajax-delete', 'CategoryController@ajaxDestroy')->name('categories.ajax_delete');

    Route::resource('posts', 'PostController')->except(['index', 'show']);
    Route::delete('posts/{post}/ajax-delete', 'PostController@ajaxDestroy')->name('posts.ajax_delete');
    Route::put('posts/{post}/ajax-toggle-approved', 'PostController@ajaxToggleApproved')->name('posts.ajax_toggle_approved');
});

Route::post('comments', 'CommentController@store')->name('comments.store');
