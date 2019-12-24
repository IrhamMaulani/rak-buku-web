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
    return response()->json(asset('storage/book_images' .'dadadsss_1575471214_5de7c86e8e683'));
});




/**
 * Admin Route
 */

// Route::group(['middleware' => ['auth', 'role:moderator']], function () {


// });




/**
 * End Admin Route
 */
