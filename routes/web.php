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

Route::get('/','Home1Controller@home')->name('home1');
Route::get('/contact','Home1Controller@contact')->name('contact');
Route::get('/secret', 'Home1Controller@secret')
  ->name('secret')
  ->middleware('can:home1.secret');


Route::resource('posts','PostController');
Route::get('dashboard', 'PostController@dashboard')->name('posts.dashboard');
Route::get('/posts/tag/{tag}', 'PostTagController@index')->name('posts.tag.index');


Route::resource('posts.comments', 'PostCommentController')->only(['index', 'store']);
Route::resource('users.comments', 'UserCommentController')->only(['store']);

Route::resource('users', 'UserController')->only(['show', 'edit', 'update']);

Route::get('mailable', function () {
  $c = App\Comment::find(1);
  return new App\Mail\CommentPostedMarkdown($c);
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');