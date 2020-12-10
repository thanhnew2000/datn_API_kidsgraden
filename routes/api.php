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
    Route::post('sua-device-user', 'UserController@edit');
    Route::post('sua-info-user/{id}', 'UserController@update');

    Route::post('check-mail-sent-ma-otp', 'ForgotPassword@sendMaOTP');
    Route::post('check-otp', "ForgotPassword@checkOTP");
    Route::post('change-password-when-forgot-pass', 'ForgotPassword@changePass');
    Route::post('remove-otp-token', 'ForgotPassword@removeOTP');
});


Route::post('update-device-user/{id}', 'Users\UserController@updateOnlyDevice');



Route::group(['namespace'=>'DiemDanh'],function(){
    Route::get('test-d-d', 'DiemDanhController@testQuery2');
}); 


Route::post('update-bell-hs/{id_hs}', 'Notification\NotificationController@updateBellHs');
Route::post('update-type-one-notifi/{id_notification}', 'Notification\NotificationController@updateTypeOneNotifi');

Route::post('get-arr-notifi-hs-by-user', 'Notification\NotificationController@getArrNotifiNumberHs');


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
        Route::get('nguoi-don-ho-id-hs/{id_hs}', 'QuanLyDonHo@getNguoiDonHoByIdHs');
    });

    Route::group(['namespace'=>'XinNghiHoc'],function(){
        Route::post('xin-nghi-hoc/{id_hs}', 'QuanLyXinNghiHocController@store');
        Route::get('all-don-xin-nghi', 'QuanLyXinNghiHocController@getAll');
        Route::get('get-don-xin-nghi-hs/{id_hs}', 'QuanLyXinNghiHocController@getAllByIdHs');
    });

    Route::group(['namespace'=>'DonDanThuoc'],function(){
        Route::post('dan-thuoc/{id_hs}', 'QuanLyDonDanThuocController@store');
        Route::get('all-dan-thuoc', 'QuanLyDonDanThuocController@getAll');
        Route::get('all-dan-thuoc-hs/{id_hs}', 'QuanLyDonDanThuocController@getAllByIdHs');
        Route::get('get-one-don-thuoc/{id}', 'QuanLyDonDanThuocController@getDonThuocById');

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

    Route::group(['namespace'=>'SucKhoe'],function(){
        // Route::get('get-suc-khoe-hoc-sinh-theo-nam/{id_hs}/{nam}', 'SucKhoeController@getSucKhoeHs');
        Route::get('get-nam-have-data-sk/{id_hs}', 'SucKhoeController@getNamHaveDataSucKhoeHs');
        Route::get('get-all-data-sk-hs/{id_hs}', 'SucKhoeController@getAllSucKhoeHs');
    }); 

    Route::group(['namespace'=>'Album'],function(){
        Route::get('get-album-by-lop/{lop_id}', 'AlbumController@getAlbumByLop');
    }); 
    
    Route::group(['namespace'=>'NamHoc'],function(){
        Route::get('get-nam-hoc-hien-tai', 'NamHocController@getNamHocHienTai');
    }); 
    Route::group(['namespace'=>'DiemDanh'],function(){
        Route::post('get-diem-danh-thang', 'DiemDanhController@getDataByThangNam');
        Route::get('test-query', 'DiemDanhController@testQuery');
    }); 

    Route::group(['namespace'=>'PhanHoiDonThuoc'],function(){
        Route::get('get-binh-luan-phan-hoi-thuoc/{id}', 'PhanHoiDonThuocController@getBinhLuanOfDonThuoc');
        Route::post('insert-binh-luan-phan-hoi', 'PhanHoiDonThuocController@store');
    }); 
    Route::group(['namespace'=>'Notification'],function(){
        Route::get('get-thong-bao-by-user/{id_nguoi_nhan}', 'NotificationController@getNofiByIdUser');
        Route::get('get-all-thong-bao-by-user/{id_nguoi_nhan}', 'NotificationController@getAllNotifiByUser');
        // Route::post('update-bell-hs/{id_hs}', 'NotificationController@updateBellHs');
    }); 
    

    Route::group(['namespace'=>'HoatDong'],function(){
        Route::get('get-hoat-dong-hoc-sinh/{id_lop}', 'HoatDongController@getHoatDong');
        Route::get('get-hoat-dong-hoc-sinh-by-nam/{id_lop}/{nam}', 'HoatDongController@getHoatDongByNam');
    }); 
    
    
   
});
