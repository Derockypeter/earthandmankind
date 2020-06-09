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
Route::get('/books', 'BookController@getAllBooks');
Route::get('/books/{book_name}', 'BookController@book');

// VIDEOS
Route::get('/getAllVideos', 'VideoController@allVideos');
Route::get('/courses', 'CourseController@allCourse');
Route::get('/course/{title}', 'CourseController@course');
Route::get('/course/{id}', 'CourseController@videos');

// POSTS
Route::get('/posts', 'PostController@getAllPost');
Route::get('/post/{title}', 'PostController@byTitle');
Route::get('/publishedPosts', 'PostController@getPosts');
Route::get('/post_id/{id}', 'PostController@getPost');
Route::get('/featuredPost', 'PostController@featuredPost');

// CONTACT US
Route::get('contact-us', 'ContactUsController@contactUS');
Route::post('/contact-us', ['as'=>'contactus.store','uses'=>'ContactUsController@contactSaveData']);


Route::group([    
    'namespace' => 'Auth',    
    'middleware' => 'api',    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

Route::post('/savePost', 'PostController@savePost');



Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/users','UserController@index');
    Route::get('users/{user}','UserController@show');

    
   
    
});

 // VIDEOS
 Route::put('/updateVideo/{video_id}', 'VideoController@editVid');
 Route::get('/video/{video_id}', 'VideoController@video'); //Viewing a single video FOR SUBSCRIBED USER
 Route::delete('/deleteVideo/{video_id}', 'VideoController@delete');

 // COURSE
 Route::post('/saveVideo', 'CourseController@store');
 Route::get('/editcourse/{id}', 'CourseController@editCourse');
 Route::put('/updatecourse/{id}', 'CourseController@updateCourse');
 Route::delete('/deletecourse/{id}', 'CourseController@deleteCourse');

 // POST
 Route::put('/disablePost/{post_id}', 'PostController@disablePost');
 Route::put('/post/{post_id}', 'PostController@editPost');
 Route::get('/editPost/{id}', 'PostController@edit');
 Route::delete('/deletePost/{post_id}', 'PostController@deletePost');
 Route::get('/disabledPosts', 'PostController@disabledPosts');
     
 // BOOKS
 Route::post('/saveBook', 'BookController@store');
 Route::get('/book/{id}', 'BookController@edit');
 Route::put('/bookEdit/{id}', 'BookController@editBook');
 Route::delete('delBook/{id}', 'BookController@delete');

//  COMMENTS
Route::post('/saveComment/{id}', 'CommentController@storeComment');
Route::get('/comments', 'CommentController@getAllComments');
Route::get('/postComment', 'CommentController@getCommentsForAPost');
ROute::get('/{user_id}/{post_id}/comment/', 'CommentController@getUserCommentInPost');
Route::get('/edit/{id}', 'CommentController@edit');
Route::put('/editComment/{id}', 'CommentController@editComment');
Route::delete('/delComment', 'CommentController@deleteComment');

// LANGUAGES
Route::post('/language-save', 'LanguageController@store');
Route::get('/languages', 'LanguageController@language');
Route::get('/edit/{id}', 'LanguageController@edit');
Route::put('/update/{id}', 'LanguageController@update');
Route::delete('/delLang/{id}', 'LanguageController@delete');



