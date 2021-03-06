<?php

namespace App\Models;
use App\Models\Lop;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChiTietDongTienHocSinh;
use App\Models\HocSinh;
use App\Models\ThangThuTien;
use App\Models\ChiTietDotThu;

class DanhSachThuTien extends Model
{
    protected $table = 'danh_sach_thu_tien';
    protected $fillable = 
    [
        "id",
        "id_chi_tiet_dot_thu",
        "id_hoc_sinh",
        "so_tien_phai_dong",
        "thong_bao",
        "ngay_bat_dau_thu",
        "ngay_ket_thuc_thu",
        "trang_thai",
        "khoi_id",
        "lop_id",
        "id_thang_thu_tien"
    ];

    public function Lop()
    {
        return $this->belongsTo(Lop::class,'lop_id','id');
    }

    public function ThangThuTien()
    {
        return $this->belongsTo(ThangThuTien::class,'id_thang_thu_tien','id');
    }
    public function ChiTietDotThu()
    {
        return $this->belongsTo(ChiTietDotThu::class,'id_chi_tiet_dot_thu','id');
    }

    public function HocSinh()
    {
        return $this->belongsTo(HocSinh::class,'id_hoc_sinh','id');
    }

    public function ChiTietDongTienHocSinh()
    {
        return $this->hasMany(ChiTietDongTienHocSinh::class,'id_danh_sach_thu_tien','id');
    }
}
