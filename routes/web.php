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
Auth::routes();


Route::get('/', function () {
    return view('welcome');
});

Route::post('/submit', 'BiksonController@sendMail');
Route::post('/getItems', 'BiksonController@getItems');
Route::post('/getImages', 'BiksonController@getImages');
