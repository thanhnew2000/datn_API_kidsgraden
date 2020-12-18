<?php

namespace App\Http\Controllers\NguoiDonHo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\NguoiDonHoRepository;

use Storage;
use Carbon\Carbon;
class QuanLyDonHo extends Controller
{

    protected $NguoiDonHoRepository;
    public function __construct(
        NguoiDonHoRepository $NguoiDonHoRepository
    )
    {
        $this->NguoiDonHoRepository = $NguoiDonHoRepository;
    }

    public function getNguoiDonHoByIdHs($id_hs){
        $data =  $this->NguoiDonHoRepository->getByIdHs($id_hs);
       return $data;
    }
    
    public function store(Request $request,$id_hs){
            $data['cmtnd'] = $request->cmtnd;
            $data['hoc_sinh_id'] = $id_hs;
            $data['phone_number'] = $request->phone_number;
            $data['ghi_chu'] = $request->ghi_chu;
            $data['ten_nguoi_don_ho'] = $request->ten_nguoi_don_ho;
            $data['date_start']  = Carbon::parse($request->ngay_bat_dau)->format('Y-m-d');
            $data['date_end']  = Carbon::parse($request->ngay_ket_thuc)->format('Y-m-d')  ;
            if(isset($request->anh_nguoi_don_ho)){
                $anh = $request->anh_nguoi_don_ho;
                $pathLoad = $anh->store('uploads/anh_nguoi_don_ho');
                $data['anh_nguoi_don_ho'] =  $request->getSchemeAndHttpHost().'/storage/'.$pathLoad;
            }
            return $this->NguoiDonHoRepository->create($data);
    }
  
}
