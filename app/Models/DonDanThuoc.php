<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChiTietDonDanThuoc;
class DonDanThuoc extends Model
{
    protected $table = 'don_dan_thuoc';
    protected $fillable = [
        'id',
        'phu_huynh_id',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'noi_dung',
        'trang_thai',
    ];
    public function ChiTietDonDanThuoc()
    {
        return $this->hasMany(ChiTietDonDanThuoc::class,'dan_dan_thuoc_id','id');
    }
}
