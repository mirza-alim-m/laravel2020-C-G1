<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('dashboard', function () {
// 	return view('layouts.master');
// });

Auth::routes();

//verifikasi email
Auth::routes(['verify' => true]);

Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('user', 'UserController');
    Route::resource('categories', 'CategoryController');
    Route::resource('databuku', 'DatabukuController');
    Route::resource('produkmasuk', 'ProdukmasukController');
    Route::resource('transaksi', 'TransaksiController');

    Route::get('change-password', 'ChangePasswordController@index');
    Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
    
});
