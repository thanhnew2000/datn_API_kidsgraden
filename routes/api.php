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
// Route::post('dan-thuoc', 'DonDanThuoc\QuanLyDonDanThuocController@index');

Route::post('login', 'AuthController@login');
// Route::group(['namespace'=>'DonDanThuoc'],function(){
//     Route::post('dan-thuoc', 'QuanLyDonDanThuocController@store');
//     Route::get('all-dan-thuoc', 'QuanLyDonDanThuocController@getAll');
// });

Route::group(['namespace'=>'Users'],function(){
    Route::get('get-hoc-sinh', 'UserController@getOne');
});



// Route::group(['namespace'=>'XinNghiHoc'],function(){
//     Route::post('xin-nghi-hoc', 'QuanLyXinNghiHocController@store');
//     Route::get('all-don-xin-nghi', 'QuanLyXinNghiHocController@getAll');
// });
// Route::group(['namespace'=>'NguoiDonHo'],function(){
//     Route::post('tao-don-ho', 'QuanLyDonHo@store');
//     Route::get('all-nguoi-don-ho', 'QuanLyDonHo@getAll');
// });

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout','AuthController@logout');
    Route::get('users', 'AuthController@users');
    Route::get('me', 'AuthController@me');

    Route::group(['namespace'=>'NguoiDonHo'],function(){
        Route::post('tao-don-ho/{id_hs}', 'QuanLyDonHo@store');
        Route::get('all-nguoi-don-ho', 'QuanLyDonHo@getAll');
    });

    Route::group(['namespace'=>'XinNghiHoc'],function(){
        Route::post('xin-nghi-hoc/{id_hs}', 'QuanLyXinNghiHocController@store');
        Route::get('all-don-xin-nghi', 'QuanLyXinNghiHocController@getAll');
        Route::get('all-don-xin-nghi-hs/{id_hs}', 'QuanLyXinNghiHocController@getAllByIdHs');
    });

    Route::group(['namespace'=>'DonDanThuoc'],function(){
        Route::post('dan-thuoc/{id_hs}', 'QuanLyDonDanThuocController@store');
        Route::get('all-dan-thuoc', 'QuanLyDonDanThuocController@getAll');
        Route::get('all-dan-thuoc-hs/{id_hs}', 'QuanLyDonDanThuocController@getAllByIdHs');
    });

    Route::group(['namespace'=>'DanhGiaGiaoVien'],function(){
        Route::post('tao-danh-gia-giao-vien', 'DanhGiaGiaoVienController@store');
    });

    Route::group(['namespace'=>'GiaoVien'],function(){
        Route::get('get-giao-vien-lop/{id}', 'GiaoVienController@getGVbyIdLop');
    });
    
    Route::group(['namespace'=>'HocSinh'],function(){
        Route::get('get-one-hoc-sinh/{id}', 'HocSinhController@getOne');
        Route::get('get-hoc-sinh-id-user/{id}', 'HocSinhController@getAllHsByIdUser');
        Route::post('edit-thong-tin-hoc-sinh/{id}', 'HocSinhController@edit');
    });
});
