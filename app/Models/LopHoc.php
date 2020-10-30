<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GiaoVien;

class LopHoc extends Model
{
    protected $table = 'lop_hoc';
    protected $fillable = [
        'id',
        'khoi_id',
        'ten_lop',
    ];

    public function GiaoVien()
    {
        return $this->hasMany(GiaoVien::class,'lop_id','id');
    }
}
