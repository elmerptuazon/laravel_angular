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

Route::group(['prefix' => 'customer'], function(){  
    Route::get('/all', 'CustomerController@index');
    Route::post('create', 'CustomerController@create');
    Route::get('item/{id}', 'CustomerController@show');
    Route::post('delete/{id}', 'CustomerController@destroy');
});
