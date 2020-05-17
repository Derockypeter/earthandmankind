<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

// BOOKS
Route::post('/saveBook', 'BookController@store');
Route::get('/books', 'BookController@getAllBooks');
Route::get('/book/{id}', 'BookController@edit');
Route::get('/books/{book_name}', 'BookController@book');
Route::put('/bookEdit/{id}', 'BookController@editBook');
Route::delete('delBook/{id}', 'BookController@delete');


// CATEGORY
Route::post('/saveCat', 'CategoryController@store');
Route::get('/getAllCat', 'CategoryController@getAllCategory');
Route::get('/editCat/{id}', 'CategoryController@edit');
Route::put('/editCat/{category_id}', 'CategoryController@updateCategory');
Route::delete('/delCat/{category_id}', 'CategoryController@delete');

// VIDEOS
Route::post('/saveVideo', 'VideoController@store');
Route::get('/edit/{id}', 'VideoController@edit');
Route::put('/updateVideo/{video_id}', 'VideoController@editVid');
Route::get('/getAllVideos', 'VideoController@allVideos');
Route::get('/video/{video_id}', 'VideoController@video')->middleware('auth:api');
Route::delete('/deleteVideo/{video_id}', 'VideoController@delete');

// POST
Route::post('/savePost', 'PostController@savePost');
Route::post('/publishPost', 'PostController@publishPost');
Route::get('/publishedPosts', 'PostController@getPosts');
Route::get('/editPost/{id}', 'PostController@edit');
Route::get('/posts', 'PostController@getAllPost');
Route::get('/category/{category_id}', 'PostController@categorizedPosts');

Route::put('/disablePost/{post_id}', 'PostController@disablePost');
Route::get('/disabledPosts', 'PostController@disabledPosts');
Route::get('/post/{post_id}', 'PostController@getPost');
Route::put('/post/{post_id}', 'PostController@editPost');
Route::get('/post/bible-teachings/', 'PostController@bibleTeaching');
Route::delete('/deletePost/{post_id}', 'PostController@deletePost');



