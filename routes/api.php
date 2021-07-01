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

// Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/adminRegister', 'AuthController@adminRegister');



Route::get('/login/facebook', 'SocialController@redirectToProvider');
Route::get('/auth/login/facebook/callback', 'SocialController@handleProviderCallback');

Route::get('/tour', 'TourController@index');
Route::post('/tour', 'TourController@store');
Route::get('/tour/edit/{id}', 'TourController@show');
Route::put('/tour/update/{id}', 'TourController@update');
Route::delete('/delTour/{id}', 'TourController@destroy');

Route::get('/tour/10', 'TourController@latestTen');
// BOOKS
Route::get('/books', 'BookController@getAllBooks');
Route::get('/books/{book_name}', 'BookController@book');
Route::post('/bookrequest', 'BookController@getUserData');
Route::get('/downloadbook/{id}', 'BookController@download');

// BOOKS
Route::get('/audio', 'BookController@getAllBooks');
Route::get('/audio/{book_name}', 'BookController@book');
Route::get('/myaudio/{id}', 'BookController@download');


// VIDEOS
Route::get('/getAllVideos', 'VideoController@index');
Route::get('/getVideo/{videoName}', 'VideoController@videoName');


// POSTS
Route::get('/posts', 'PostController@getAllPost');
Route::get('/post/{title}', 'PostController@byTitle');
Route::get('/publishedPosts', 'PostController@getPosts');
Route::get('/post_id/{id}', 'PostController@getPost');
Route::get('/featuredPost', 'PostController@featuredPost');
Route::get('/getPostsByLanguage/{language_id}', 'PostController@getPostsByLanguage');
Route::get('/getDefaultPosts', 'PostController@getDefaultPosts');
Route::post('/upload-image', 'PostController@uploadImageForPost');




// CONTACT US
Route::get('contact-us', 'ContactUsController@contactUS');
Route::post('/contact-us', ['as'=>'contactus.store','uses'=>'ContactUsController@contactSaveData']);
// LANGUAGE
Route::get('/languages', 'LanguageController@language');



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
Route::post('/postImageUploader', 'ImageController@postImageUploader');


// Audios
Route::apiResource('audio', 'AudioController');
Route::get('/audiophile/{audio_name}', 'AudioController@audio');
Route::get('/audiop/{audio_name}', 'AudioController@getEdit');


Route::post('/saveVideo', 'CourseController@store');

Route::get('gallery', 'ImageGalleryController@general');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/users','UserController@index');
    Route::get('users/{user}','UserController@show');
    Route::apiResource('image-gallery', 'ImageGalleryController'); //Dictionary

     // VIDEOS
 Route::put('/updateVideo/{video_id}', 'VideoController@editVid');
 Route::get('/video/{video_id}', 'VideoController@video'); //Viewing a single video FOR SUBSCRIBED USER
 Route::post('/addVideo', 'VideoController@storeVideo');
 Route::delete('/deleteVideo/{video_id}', 'VideoController@delete');

 // POST
 Route::put('/disablePost/{post_id}', 'PostController@disablePost');
 Route::put('/post/{post_id}', 'PostController@editPost');
 Route::get('/editPost/{id}', 'PostController@edit');
 Route::delete('/deletePost/{post_id}', 'PostController@deletePost');
 Route::get('/disabledPosts', 'PostController@disabledPosts');
     
 // BOOKS
 Route::post('/saveBook', 'BookController@store');
 Route::get('/book/{id}', 'BookController@edit');
 Route::put('/bookEdit/{id}', 'BookController@update');
 Route::delete('delBook/{id}', 'BookController@delete');


// LANGUAGES
Route::post('/language-save', 'LanguageController@store');
Route::get('/edit/{id}', 'LanguageController@edit');
Route::put('/update/{id}', 'LanguageController@update');
Route::delete('/delLang/{id}', 'LanguageController@delete');

// Tour


    
});




