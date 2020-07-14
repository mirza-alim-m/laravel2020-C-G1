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

Auth::routes(['verify' => true]);

Route::get('auth/{provider}', 'Auth\SocialiteController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback');

Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
    Route::resource('user', 'UserController');
    Route::resource('categories', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::resource('stockin', 'StockinController');
    Route::resource('stockout', 'StockoutController');

    Route::get('change-password', 'PasswordController@edit')->name('change-password');
    Route::patch('change-password', 'PasswordController@update')->name('change-password.update');

    Route::get('update-profile', 'ProfileController@edit')->name('update-profile');
    Route::patch('update-profile', 'ProfileController@update')->name('update-profile.update');
});
