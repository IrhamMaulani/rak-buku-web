<?php

use Illuminate\Http\Request;

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



Route::prefix('admin')->group(function () {

    // 
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('reputation', 'ReputationController');

    Route::resource('book', 'BookController');

    Route::put('/user/{userId}/ban', 'UserBanController@update');
});

//Auth
Route::post('/login', 'Auth\LoginApiController@login')->name('login');
Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::post('/logout', 'Auth\LoginApiController@logout');
    Route::post('/change-password', 'Auth\LoginApiController@changePassword');
    Route::resource('bookmark', 'BookmarkController');
    Route::resource('score', 'ScoreController');
    Route::post('/tag', 'TagController@store');
    Route::post('/author', 'AuthorController@store');
    Route::post('/publisher', 'PublisherController@store');
    Route::post('/book', 'BookController@store');
    Route::post('/review', 'ReviewController@store');

    Route::post('/review/{reviewId}/update', 'ReviewController@update');

    Route::resource('review-response', 'ReviewResponseController');

    Route::put('/user/{userName}/edit', 'ProfileController@update');

    Route::get('/user-review', 'UserReviewController@index');
});

Route::get('/book', 'BookController@index');
Route::get('/book/{slug}', 'BookController@show');

Route::get('/review', 'ReviewController@index');

Route::get('/tag', 'TagController@index');

Route::get('/author', 'AuthorController@index');

Route::get('/publisher', 'PublisherController@index');

Route::get('/popular-book', 'PopularBookController@index');

Route::get('/user/{userName}', 'ProfileController@show');

Route::get('/review-response-process', 'ReviewResponseProcessController@index');





//
