<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChiTietDonDanThuoc;
use Carbon\Carbon;
class DonDanThuoc extends Model
{
    protected $table = 'don_dan_thuoc';
    protected $fillable = [
        'id',
        'hoc_sinh_id',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'noi_dung',
        'trang_thai',
    ];
    public function ChiTietDonDanThuoc()
    {
        return $this->hasMany(ChiTietDonDanThuoc::class,'don_dan_thuoc_id','id');
    }

    
    // public function getNgayBatDauAttribute($value)
    // {
    //     $date = Carbon::parse($value);
    //     return $date->format('Y-m-d');
    // }

    // public function getNgayKetThucAttribute($value)
    // {
    //     $date = Carbon::parse($value);
    //     return $date->format('Y-m-d');
    // }
}
