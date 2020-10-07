<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonDanThuoc extends Model
{
    protected $table = 'don_dan_thuoc';
    protected $fillable = [
        'id',
        'dan_dan_thuoc_id',
        'ten_thuoc',
        'don_vi',
        'lieu_luong',
        'phan_hoi_giao_vien',
        'trang_thai',
    ];
}
