<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGiaGiaoVien extends Model
{
    protected $table = 'danh_gia_phu_huynh';
    protected $fillable = [
        'id',
        'phu_huynh_id',
        'giao_vien_id',
        'noi_dung',
        'ngay_danh_gia',
    ];
}
