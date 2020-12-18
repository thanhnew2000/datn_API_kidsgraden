<?php

namespace App\Http\Controllers\PhanHoiDonThuoc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PhanHoiDonThuocRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\HocSinhRepository;


class PhanHoiDonThuocController extends Controller
{

    protected $PhanHoiDonThuocRepository;
    public function __construct(
        PhanHoiDonThuocRepository $PhanHoiDonThuocRepository,
        NotificationRepository $NotificationRepository,
        HocSinhRepository $HocSinhRepository
    )
    {
        $this->PhanHoiDonThuocRepository = $PhanHoiDonThuocRepository;
        $this->NotificationRepository = $NotificationRepository;
        $this->HocSinhRepository = $HocSinhRepository;
    }

    public function store(Request $request){
        $data =  $request->all();
        // return $data;
        $data['type'] = 1;
        // return $data;
        $this->PhanHoiDonThuocRepository->create($data);
        $id_hs = $data['nguoi_phan_hoi_id'];
        $hoc_sinh = $this->HocSinhRepository->find($id_hs);
        // return $hoc_sinh->ten;
        $get_giao_vien = $hoc_sinh->getLop->GiaoVien()->select('user_id')->get();
        // return $get_giao_vien;
        foreach ($get_giao_vien as $key => $data_giao_vien) {
            $link = [
                'route_name' => 'don-dan-thuoc',
                'params' => ['id_don' => $request->don_dan_thuoc_id]
            ];
            $route = json_encode($link);
            $thongbao['title'] =$hoc_sinh->ten.' đã phản hồi về đơn dặn thuốc';
            $thongbao['content'] ='nội dung';
            $thongbao['route'] = $route;
            $thongbao['user_id'] = $data_giao_vien->user_id;
            $thongbao['auth_id'] = $id_hs;
            // $thongbao['id_hs'] = $id_hs;
            $thongbao['role'] = 1;
            $this->NotificationRepository->create($thongbao);
        }
    }

    public function getBinhLuanOfDonThuoc($id){
      $data =  $this->PhanHoiDonThuocRepository->getBinhLuanOfDonThuoc($id);  
    //   return $data;
      $data->each(function ($item){
        if($item->type == 1){
            $item->HocSinh;
        }else{
         $item->User->GiaoVien;
        }
      });
    return $data;
    }
}
