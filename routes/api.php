<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => ['auth:web']], function () {
//     Route::post('/image', 'APIController@uploadImage');
//     Route::post('/categories', 'APIController@createCategory');
// });

Route::get('/raw', 'APIController@getRawImage');
Route::get('/image', 'APIController@getRandomImage');
Route::get('/image-id/{id}', 'APIController@getImage');
Route::get('/image/{category}', 'APIController@getRandomImageFiltered');
Route::get('/raw/{category}', 'APIController@getRawImageFiltered');

Route::get('/categories', 'APIController@getCategories');

Route::get('/statistics', 'APIController@getStats');
