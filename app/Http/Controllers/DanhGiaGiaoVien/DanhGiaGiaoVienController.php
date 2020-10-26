<?php

namespace App\Http\Controllers\DanhGiaGiaoVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\DanhGiaGiaoVienRepository;
use Storage;
use Carbon\Carbon;
class DanhGiaGiaoVienController extends Controller
{
        protected $DanhGiaGiaoVienRepository;
        public function __construct(
            DanhGiaGiaoVienRepository $DanhGiaGiaoVienRepository
        )
        {
            $this->DanhGiaGiaoVienRepository = $DanhGiaGiaoVienRepository;
        }

        public function store(Request $request){
            // return $request->all();
            $data['phu_huynh_id'] = $request->phu_huynh_id;
            $data['giao_vien_id'] = $request->giao_vien_id;
            $data['noi_dung'] = $request->noi_dung;
            $data['ngay_danh_gia']  = Carbon::now()->format('Y-m-d');
           
            return $this->DanhGiaGiaoVienRepository->create($data);
    }
    
}
