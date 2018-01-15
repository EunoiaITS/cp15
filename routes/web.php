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
    return view('welcome');
});
Route::post('superuser/create', 'superUserController@saveUser');
Route::get('/superuser', 'superUserController@saveUser');
Route::get('/qr-orders', function () {
    return view('qr_orders.add');
});
