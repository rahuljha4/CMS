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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    // Home page route
    Route::get('/home', 'HomeController@index')->name('home');

    // Category Resources
    Route::resource('categories', 'CategoriesController');

    // Posts Resources
    Route::resource('posts', 'PostsController');

    // Tags Resources
     Route::resource('tags', 'TagsController');


    // Trashed Post route
    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');

    // Restore post
    Route::put('restore-post/{post}', 'PostsController@restore')->name('restore-posts');
});
