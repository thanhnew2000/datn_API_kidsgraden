<?php

namespace App\Http\Controllers\XinNghiHoc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\XinNghiHocRepository;
use Carbon\Carbon;

class QuanLyXinNghiHocController extends Controller
{

    protected $XinNghiHocRepository;
    public function __construct(
        XinNghiHocRepository $XinNghiHocRepository
    )
    {
        $this->XinNghiHocRepository = $XinNghiHocRepository;
    }

    public function getAll(){
        $data =  $this->XinNghiHocRepository->getAll();
       return $data;
    }
    public function getAllByIdHs($id){
        $data =  $this->XinNghiHocRepository->getAllByIdHs($id);
       return $data;
    }

    public function store(Request $request,$id_hs)
    {
        // $data =  $request->all();
        $data['hoc_sinh_id']  = $id_hs;
        $data['lop_id']  = $request->lop_id;
        $data['ngay_bat_dau']  = Carbon::parse($request->ngay_bat_dau)->format('Y-m-d');
        $data['ngay_ket_thuc']  = Carbon::parse($request->ngay_ket_thuc)->format('Y-m-d') ;
        $data['noi_dung']  = $request->noi_dung;

        $this->XinNghiHocRepository->create($data);
        
       return 'thành công';
    }

    public function getOne($id_don){
        return $this->XinNghiHocRepository->find($id_don);
    }
}
