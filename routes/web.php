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

Auth::routes(['verify' => true]);

Route::get('home', 'HomeController@index')->name('home');

Route::get('posts', 'PostController@index')->name('posts.index');
Route::get('posts/create', 'PostController@create')->name('posts.create');
Route::post('posts', 'PostController@store')->name('posts.store');
Route::get('posts/{post}', 'PostController@show')->name('posts.show');
Route::get('posts/{post}/edit', 'PostController@edit')->name('posts.edit');
Route::patch('posts/{post}', 'PostController@update')->name('posts.update');

// Route::patch('posts/{post}', function(){
//     return 'Hello World';
// });

Route::delete('posts/{post}', 'PostController@destroy')->name('posts.destroy');

Route::resource('comments','CommentController');

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');




//Route::post('/mypage', 'Auth\TimelineController@storeMyImg');