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

Route::get('/', function () {
    return redirect(route('panel_user_show'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/users', 'Panel\UserController@showAll')->name('panel_user_show');
Route::get('/admin/users/edit/{id}', 'Panel\UserController@show')->name('panel_user_single_show');
Route::put('/admin/users/edit', 'Panel\UserController@edit')->name('panel_user_edit');
Route::put('/admin/users/delete', 'Panel\UserController@delete')->name('panel_user_delete');
Route::put('/admin/users/restore', 'Panel\UserController@restore')->name('panel_user_restore');
Route::get('/admin/users/search', 'Panel\UserController@search')->name('panel_user_search');

Route::get('/admin/blog', 'Panel\BlogController@showAll')->name('panel_blog_show');
Route::get('/admin/blog/edit/{id}', 'Panel\BlogController@show')->name('panel_blog_single_show');
Route::put('/admin/blog/edit', 'Panel\BlogController@edit')->name('panel_blog_edit');
Route::put('/admin/blog/delete', 'Panel\BlogController@delete')->name('panel_blog_delete');
Route::put('/admin/blog/restore', 'Panel\UserController@restore')->name('panel_blog_restore');
Route::get('/admin/blog/search', 'Panel\UserController@search')->name('panel_blog_search');