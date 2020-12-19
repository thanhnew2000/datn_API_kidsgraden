<?php

namespace App\Http\Controllers\XinNghiHoc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\XinNghiHocRepository;
use App\Repositories\HocSinhRepository;
use App\Repositories\NotificationRepository;

use Carbon\Carbon;

class QuanLyXinNghiHocController extends Controller
{

    protected $XinNghiHocRepository;
    public function __construct(
        XinNghiHocRepository $XinNghiHocRepository,
        HocSinhRepository $HocSinhRepository,
        NotificationRepository $NotificationRepository

    )
    {
        $this->XinNghiHocRepository = $XinNghiHocRepository;
        $this->HocSinhRepository = $HocSinhRepository;
        $this->NotificationRepository = $NotificationRepository;


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
        
        // quang lx
        $hoc_sinh = $this->HocSinhRepository->find($id_hs);
        $get_giao_vien = $hoc_sinh->getLop->GiaoVien()->get();
        $link = [
            'route_name' => 'don-xin-nghi-hoc',
        ];
        $route = json_encode($link);
        foreach ($get_giao_vien as $key => $data_giao_vien) {
            $thongbao=[];
            $thongbao['title'] ='Thông báo đơn nghỉ học';
            $thongbao['content'] ='nội dung';
            $thongbao['route'] = $route;
            $thongbao['user_id'] = $data_giao_vien->user_id;
            $thongbao['role'] = 3;
            $thongbao['auth_id'] =$hoc_sinh->user_id;
            $this->NotificationRepository->create($thongbao);
        }
        // return $thongbao;
        
         return 'thành công';
    }

    public function getOne($id_don){
        return $this->XinNghiHocRepository->find($id_don);
    }
}
