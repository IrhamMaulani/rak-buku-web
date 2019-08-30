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
    return view('index');
});




/**
 * Admin Route
 */

// Route::group(['middleware' => ['auth', 'role:moderator']], function () {

Route::prefix('admin')->group(function () {

    // Route::get('home', 'AdminController@index');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
});
// });




/**
 * End Admin Route
 */
