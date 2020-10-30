<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HocSinh;
use App\Models\GiaoVien;
use App\User;
use Illuminate\Notifications\Notifiable;
use QuanVT\Firebase\SyncWithFirebase;

class PhanHoiDonThuoc extends Model
{
    use Notifiable, SyncWithFirebase;
    protected $table = 'phan_hoi_don_thuoc';
    protected $fillable = [
        'don_dan_thuoc_id',
        'nguoi_phan_hoi_id',
        'noi_dung',
        'type',
    ];

    public function HocSinh()
    {
        return $this->hasOne(HocSinh::class,'id','nguoi_phan_hoi_id');
    }

    public function GiaoVien()
    {
        return $this->hasOne(GiaoVien::class,'id','nguoi_phan_hoi_id');
    }

    public function User()
    {
        return $this->hasOne(User::class,'id','nguoi_phan_hoi_id');
    }
}