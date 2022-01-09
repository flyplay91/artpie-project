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

Route::get('api-select-gallerys', 'ApiSelectGallerysController@index');
Route::post('api-search-gallerys', 'ApiSearchGallerysController@index');

Route::post('api-get-gallery', 'ApiGalleryController@index');
Route::post('api-investor-user', 'ApiInvestorUserController@index');
Route::post('api-admin-user', 'ApiAdminUserController@index');
Route::post('api-billing', 'ApiBillingController@index');



Route::post('api-select-header-data', 'ApiChangeHeaderDataController@index');
Route::get('api-select-collections', 'ApiSelectCollectionsController@index');
Route::post('api-categories', 'ApiCategoriesController@index');
Route::post('api-update-categories', 'ApiUpdateCategoriesController@index');
Route::post('api-delete-categories', 'ApiDeleteCategoriesController@index');
Route::post('api-get-categories', 'ApiGetCategoriesController@index');

Route::post('api-artists', 'ApiArtistsController@index');
Route::post('purchase-fragments', 'ApiGalleryController@purchaseFragments');
Route::post('confirm-deposit', 'ApiDepositController@confirmDeposit');
Route::post('api-get-artist', 'ApiGetArtistController@index');
Route::post('api-update-artist', 'ApiUpdateArtistController@index');
Route::post('api-delete-artist', 'ApiDeleteArtistController@index');


