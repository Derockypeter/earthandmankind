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


// For single post !!Did this for Facebook and single post ssr!!
Route::get('post/{title}', 'PostController@byTitle');

Route::get('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*'); //For SPA vue

