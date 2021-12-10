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

Route::post('api-select-gallerys', 'ApiSelectGallerysController@index');
Route::post('api-get-gallery', 'ApiGetGalleryController@index');

Route::post('api-select-collections', 'ApiSelectCollectionsController@index');
Route::post('api-categories', 'ApiCategoriesController@index');
Route::post('api-artists', 'ApiArtistsController@index');
