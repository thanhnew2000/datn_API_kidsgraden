<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonDanThuoc extends Model
{
    protected $table = 'chi_tiet_don_thuoc';
    protected $fillable = [
        'id',
        'don_dan_thuoc_id',
        'ten_thuoc',
        'ghi_chu',
        'don_vi',
        'lieu_luong',
        'phan_hoi_giao_vien',
        'anh'
    ];
}
