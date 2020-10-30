<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HocSinh;
use App\Models\GiaoVien;
class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'id',
        'name',
        'avatar',
        'email',
    ];

    public function HocSinh()
    {
        return $this->hasOne(HocSinh::class,'user_id','id');
    }

    public function GiaoVien()
    {
        return $this->hasOne(GiaoVien::class,'id','user_id');
    }
}
