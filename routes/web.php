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
Route::post('/superuser/users-delete', 'superUserController@deleteUsers');

/**
 * Admin Executive Manager routes
 */
Route::post('/qr-orders/addQROrder', 'AEMController@addQROrder');
Route::post('/editQROrder', 'AEMController@editQROrder');
Route::post('suppliers/addSupplier', 'AEMController@addSupplier');


Route::get('/qr-orders', function () {
    return view('qr_orders.add');
});
Route::get('/suppliers', function () {
    return view('suppliers.add');
});
Route::get('/qr-orders/view', function () {
    return view('qr_orders.view');
});

/**
 * Director routes
 */

/**
 * Supplier routes
 */
