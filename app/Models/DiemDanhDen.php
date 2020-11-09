<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiemDanhDen extends Model
{
    protected $table = 'diem_danh_den';
    protected $fillable = [
        'id',
        'ngay_diem_danh_den',
        'hoc_sinh_id',
        'user_id',
        'giao_vien_id',
        'chu_thich',
        'trang_thai',
        'phu_huynh',
        'phieu_an',
        'lop_id',
    ];  
}
