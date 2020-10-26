<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LopHoc;

class HocSinh extends Model
{
    protected $table = 'hoc_sinh';
    protected $fillable = [
        'id',
        'ten',
        'gioi_tinh',
        'ten_thuong_goi',
        'avatar',
        'ngay_sinh',
        'dan_toc',
        'ngay_vao_truong',
        'doi_tuong_chinh_sach_id',
        'hoc_sinh_khuyet_tat',
        'ten_cha',
        'ngay_sinh_cha',
        'cmtnd_cha',
        'dien_thoai_cha',
        'ten_me',
        'cmtnd_me',
        'dien_thoai_me',
        'dien_thoai_dang_ki',
        'ho_khau_thuong_tru_matp',
        'ho_khau_thuong_tru_maqh',
        'ho_khau_thuong_tru_xaid',
        'ho_khau_thuong_tru_so_nha',
        'noi_o_hien_tai_matp',
        'noi_o_hien_tai_maqh',
        'noi_o_hien_tai_xaid',
        'noi_o_hien_tai_so_nha',
        'user_id',
        'lop_id',
        'type',
    ];

    public function getLop()
    {
        return $this->belongsTo(LopHoc::class,'lop_id','id');
    }

}
