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

// Auth::routes();

Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::group(['middleware' => ['auth:web']], function () {
    Route::post('/api/image', 'APIController@uploadImage');
    Route::post('/api/categories', 'APIController@createCategory');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/admin', function() {
    return view('admin');
});
