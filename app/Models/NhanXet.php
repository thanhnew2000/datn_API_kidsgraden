<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GiaoVien;


class NhanXet extends Model
{
    protected $table = "nhan_xet";
    protected $fillable = [
        'giao_vien_id',
        'hoc_sinh_id',
        'nhan_xet_ngay',
        'bua_an',
        'ngu',
        've_sinh',
    ];

    public function GiaoVien()
    {
        return $this->hasOne(GiaoVien::class,'id','giao_vien_id');
    }
}
