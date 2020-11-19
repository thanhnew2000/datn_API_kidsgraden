<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGiaGiaoVien extends Model
{
    protected $table = 'danh_gia_phu_huynh';
    protected $fillable = [
        'id',
        'hoc_sinh_id',
        'lop_id',
        'noi_dung',
        'ngay_danh_gia',
    ];
}
