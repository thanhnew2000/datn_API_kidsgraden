<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiaoVien extends Model
{
    protected $table = 'giao_vien';
    protected $fillable = [
        'id',
        'ma_gv',
        'user_id',
        'lop_id',
        'ten',
        'gioi_tinh',
        'dien_thoai',
        'ngay_sinh',
        'anh',
        'dan_toc',
        'trinh_do',
        'chuyen_mon',
        'noi_dao_tao',
        'nam_tot_nghiep',
        'ho_khau_thuong_tru_matp',
        'ho_khau_thuong_tru_maqh',
        'ho_khau_thuong_tru_xaid',
        'ho_khau_thuong_tru_so_nha',
        'noi_o_hien_tai_matp',
        'noi_o_hien_tai_maqh',
        'noi_o_hien_tai_xaid',
        'noi_o_hien_tai_so_nha',
        'type',
    ];
}
