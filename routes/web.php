<?php

use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//   return view('welcome');
// });

// Front
Route::get('/register', 'Auth\AuthController@register')->name('register');
Route::post('/register', 'Auth\AuthController@storeUser');

Route::get('/login', 'Auth\AuthController@login')->name('login');
Route::post('/login', 'Auth\AuthController@authenticate');
Route::get('logout', 'Auth\AuthController@logout')->name('logout');


Route::resource('', 'front\GallerysController');

Route::resource('contact-gallery', 'front\ContactForGalleryController');
Route::resource('setting', 'front\SettingController')->middleware('auth');
Route::resource('update-user-info', 'front\UpdateUserInfoController')->middleware('auth');
Route::resource('checkout', 'front\CheckoutController')->middleware('auth');
Route::resource('pay', 'front\PayController')->middleware('auth');
Route::resource('order', 'front\OrderInfoController')->middleware('auth');



// Admin
Route::group(['middleware' => 'checkSuperAdmin'], function () {
  Route::resource('admin-header-data', 'AdminHeaderDataController');
  Route::resource('admin-user', 'AdminUsersController');
  Route::resource('admin-order', 'AdminOrdersController');
  Route::resource('admin-deposit', 'AdminDepositsController');
  Route::resource('admin-widraw', 'AdminWidrawsController');
  Route::resource('admin-transaction', 'AdminTransactionsController');

  Route::resource('admin-gallery', 'AdminGallerysController');
  Route::resource('admin-collection', 'AdminCollectionsController');
});