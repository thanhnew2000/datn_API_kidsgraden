<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\DanhSachThuTien;

class DanhSachThuTienRepository extends BaseModelRepository
{

    protected $model;
    public function __construct(
        DanhSachThuTien $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getModel()
    {
        return DanhSachThuTien::class;
    }
    
    // public function getIdDotThuFromIdHs($id){
    //     return $this->model
    //     ->select('id_dot_thu_tien')
    //     ->where('id_hoc_sinh',$id)
    //     ->groupBy('id_dot_thu_tien')->get();
    // }

    public function get_arr_id_thang_thu_tien($id){
        $id_thang_thu_tien = $this->model
        ->where('id_hoc_sinh',$id)
        ->select('id_thang_thu_tien',DB::raw('SUM(so_tien_phai_dong) as so_tien_phai_dong'),DB::raw('SUM(so_tien_da_dong) as so_tien_da_dong'))
        ->groupBy('id_thang_thu_tien')
        ->get();
        return $id_thang_thu_tien;
    }


    public function getDanhSachByArrIdThangThu($arr){
        $value =  $this->model
        ->whereIn('id_thang_thu_tien',$arr)->get();
        return $value;
    }


    public function getIdDotThuFromIdHs($id){
        return $this->model
        ->where('id_hoc_sinh',$id)
        ->select('id_dot_thu_tien', DB::raw('SUM(so_tien_phai_dong) as so_tien_phai_dong'))
        ->groupBy('id_dot_thu_tien')
        ->get();
    }
    public function getTongTienFormArrIdDotThuOfThang($arr_dot_thu){
        return $this->model->whereIn('id_dot_thu_tien',$arr_dot_thu)
        ->select(DB::raw('SUM(so_tien_phai_dong) as so_tien_phai_dong'))
        ->get();
    }
    public function get_id_thang_thu_tien($id){
        $id_thang_thu_tien = $this->model
        ->where('id_hoc_sinh',$id)
        ->select('id_thang_thu_tien')
        ->get();
        return $id_thang_thu_tien;
    }

    public function getDanhSachThuTienOfHs($id_thang_thu_tien,$id){
        $danh_sach = $this->model
        ->where('id_thang_thu_tien',$id_thang_thu_tien)
        ->where('id_hoc_sinh',$id)
        ->get();
        return $danh_sach;
    }

    public function getOneDanhSachThuTienByIdChiTietDot($id_chi_tiet_dot,$id_hs){
        $danh_sach = $this->model
        ->where('id_chi_tiet_dot_thu',$id_chi_tiet_dot)
        ->where('id_hoc_sinh',$id_hs)
        ->first();
        return $danh_sach;
    }
   
}
