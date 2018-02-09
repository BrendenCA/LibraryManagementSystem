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

Route::resource('catalog', 'CatalogController');
Route::resource('genre', 'GenreController');
Route::resource('author', 'AuthorController');

Auth::routes();
Route::get('/dashboard', 'DashboardController@index');
Route::get('/credits', 'DashboardController@credits');

Route::get('/role/edit', 'DashboardController@editRole');
Route::post('/role/update', 'DashboardController@updateRole');

Route::get('/library', 'LibraryController@index');
Route::get('/library/{id}/borrow', 'LibraryController@borrow');
Route::get('/library/{id}/return', 'LibraryController@return');

Route::post('/payment/paypal', 'PaypalController@store');
Route::get('/payment/paypal/status', 'PaypalController@getPaymentStatus');
