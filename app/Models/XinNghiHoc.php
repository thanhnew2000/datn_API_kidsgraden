<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XinNghiHoc extends Model
{
    protected $table = 'don_nghi_hoc';
    protected $fillable = [
        'id',
        'phu_huynh_id',
        'hoc_sinh_id',
        'giao_vien_id',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'noi_dung',
        'trang_thai',
    ];
}
