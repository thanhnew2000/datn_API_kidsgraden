<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NguoiDonHo;

class DiemDanhVe extends Model
{
    protected $table = 'diem_danh_ve';
    protected $fillable = [
        'id',
        'ngay_diem_danh_ve',
        'hoc_sinh_id',
        'user_id',
        'giao_vien_id',
        'chu_thich',
        'trang_thai',
        'phu_huynh',
        'nguoi_don_ho_id',
        'lop_id',
    ];

    public function NguoiDonHo()
    {
        return $this->hasOne(NguoiDonHo::class,'id','nguoi_don_ho_id');
    }


}
