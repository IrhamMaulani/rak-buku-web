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
});

Route::resource('book', 'BookController');

Route::get('/review', 'ReviewController@index');

Route::resource('tag', 'TagController');

Route::resource('author', 'AuthorController');

Route::resource('publisher', 'PublisherController');

Route::get('/popular-book', 'PopularBookController@index');

Route::get('/review-response-process', 'ReviewResponseProcessController@index');


//Auth
Route::post('/login', 'Auth\LoginApiController@login')->name('login');
Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::post('/logout', 'Auth\LoginApiController@logout');
    Route::resource('bookmark', 'BookmarkController');
    Route::resource('score', 'ScoreController');
});

//
