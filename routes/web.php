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


// Front
Route::get('/register', 'Auth\AuthController@register')->name('register');
Route::post('/register', 'Auth\AuthController@storeUser');

Route::get('/login', 'Auth\AuthController@login')->name('login');
Route::post('/login', 'Auth\AuthController@authenticate');
Route::get('logout', 'Auth\AuthController@logout')->name('logout');
Route::get('/', function () {
    return view('front/pages/home');
});


Route::resource('gallery', 'front\GallerysController');


// Admin
// Route::get('/admin', function () {
//     return view('admin/gallerys/index');
// });

Route::resource('admin-gallery', 'AdminGallerysController');
Route::resource('admin-collection', 'AdminCollectionsController');