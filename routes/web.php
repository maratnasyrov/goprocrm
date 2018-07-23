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

Route::group(['middleware'=>'auth'], function() {
    Route::resource('/tender', 'TenderController');
    Route::resource('/manager', 'ManagerController');
    Route::resource('/customer', 'CustomerController');
    Route::resource('/merchandise', 'MerchandiseController');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
