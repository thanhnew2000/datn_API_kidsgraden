<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'AuthController@login');
Route::group(['namespace'=>'DonDanThuoc'],function(){
    Route::post('dan-thuoc', 'QuanLyDonDanThuocController@store');
});
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout','AuthController@logout');
    Route::get('users', 'AuthController@users');
    Route::get('me', 'AuthController@me');
   
    
});
