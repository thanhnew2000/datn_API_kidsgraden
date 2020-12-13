<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KhoanThu;
use App\Models\NamHoc;
use App\Models\ChiTietDotThuTien;


class ThangThuTien extends Model
{
    protected $table = 'thang_thu_tien';
    protected $fillable = 
    [
        "id",
        "thang_thu",
        "nam_thu",
        'id_nam_hoc'
    ];

    public function NamHoc()
    {
        return $this->belongsTo(NamHoc::class,'id_nam_hoc','id');
    }


    public function ChiTietDotThuTien()
    {
        return $this->hasMany(ChiTietDotThuTien::class,'id_dot_thu_tien','id');
    }
}
