<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonNghiHoc extends Model
{
    protected $table = 'don_nghi_hoc';
    protected $fillable = [
        'id',
        'lop_id',
        'hoc_sinh_id',
        'giao_vien_id',
        'ngay_ket_thuc',
        'ngay_bat_dau',
        'noi_dung',
        'trang_thai',
    ];
}
