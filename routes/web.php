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

Route::get('/', 'UsersController@dashboard');

Route::get('/login', 'UsersController@login');
Route::post('/login', 'UsersController@login');
Route::get('/logout', 'UsersController@logout');
Route::get('/profile/change-password', 'UsersController@changePassword');
Route::post('/profile/change-password', 'UsersController@changePassword');


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
Route::get('/qr-orders/add-qr-order', 'AEMController@addQROrder');
Route::post('/qr-orders/add-qr-order', 'AEMController@addQROrder');
Route::post('/qr-orders/edit', 'AEMController@editQROrder');
Route::post('/qr-orders/delete', 'AEMController@deleteQROrder');
Route::post('/qr-orders/delete-item', 'AEMController@deleteQRItem');

Route::get('/qr-orders/view', 'AEMController@viewQROrder');

Route::get('suppliers/add-supplier', 'AEMController@addSupplier');
Route::post('suppliers/add-supplier', 'AEMController@addSupplier');

Route::get('suppliers/view-supplier', 'AEMController@viewSupplier');
Route::post('suppliers/edit-supplier', 'AEMController@editSupplier');
Route::post('suppliers/delete-supplier', 'AEMController@deleteSupplier');

Route::post('suppliers/invite-suppliers', 'AEMController@inviteSuppliers');
Route::get('suppliers/invite-suppliers', 'AEMController@inviteSuppliers');
Route::get('suppliers/invite', 'AEMController@inviteSuppliers');

Route::get('/tender-summery', 'AEMController@tenderSummery');
Route::get('/view-supplier-quotation', 'AEMController@supplierQuotations');

/**
 * Director routes
 */
Route::get('/qr-orders', 'DirectorController@viewQR');
Route::get('/suppliers', 'DirectorController@viewSuppliers');
Route::get('/approve-quotations', 'DirectorController@approveQuotations');
Route::post('/approve-quotations', 'DirectorController@approveQuotations');
Route::get('/allow-price-show', 'DirectorController@allowPriceShow');
Route::post('/allow-price-show', 'DirectorController@allowPriceShow');

/**
 * Supplier routes
 */
Route::get('/profile', 'SupplierController@viewProfile');
Route::post('/profile/edit', 'SupplierController@editProfile');
Route::get('/supplier-controller/view-qr/', 'SupplierController@viewQR');
Route::post('/supplier-controller/submit-qr/', 'SupplierController@viewQR');

/**
 * Supplier routes
 */

Route::get('/excel-upload', 'ExcelUploadController@uploadFile');
Route::post('/import-data', 'ExcelUploadController@importData');
