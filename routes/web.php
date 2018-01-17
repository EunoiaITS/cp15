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

/*
 * Super user routes
 * */
Route::post('/superuser', 'superUserController@saveUser');
Route::get('/superuser', 'superUserController@saveUser');
Route::get('/superuser/users-list', 'superUserController@viewUsers');
Route::post('/superuser/users-edit', 'superUserController@editUsers');

Route::get('/qr-orders', function () {
    return view('qr_orders.add');
});
