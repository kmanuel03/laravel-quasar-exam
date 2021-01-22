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

Route::group(['prefix' => 'user'], function() {
    Route::get('list', 'UserController@list');
    Route::get('albums/{id}', 'UserController@listAlbums');
});

Route::group(['prefix' => 'album'], function() {
    Route::get('list', 'AlbumController@list');
    Route::get('{id}/get-photos', 'AlbumController@getPhotos');
    Route::group(['prefix' => 'photo'], function() {
        Route::post('store', 'AlbumController@store');
        Route::get('details/{id}', 'AlbumController@details');
        Route::post('edit/{id}', 'AlbumController@edit');
        Route::post('delete/{id}', 'AlbumController@delete');
    });
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
