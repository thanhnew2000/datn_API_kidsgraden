<?php

namespace App\Http\Controllers\DonDanThuoc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\QuanLyDonDanThuocRepository;
use App\Repositories\ChiTietDonDanThuocRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\HocSinhRepository;
use Storage;
use Carbon\Carbon;
class QuanLyDonDanThuocController extends Controller
{
    protected $QuanLyDonDanThuocRepository;
    protected $ChiTietDonDanThuocRepository;
    protected $NotificationRepository; 
    protected $HocSinhRepository;
    public function __construct(
        ChiTietDonDanThuocRepository $ChiTietDonDanThuocRepository,
        QuanLyDonDanThuocRepository $QuanLyDonDanThuocRepository,
        NotificationRepository $NotificationRepository,
        HocSinhRepository $HocSinhRepository

    )
    {
        $this->QuanLyDonDanThuocRepository = $QuanLyDonDanThuocRepository;
        $this->ChiTietDonDanThuocRepository = $ChiTietDonDanThuocRepository;
        $this->NotificationRepository = $NotificationRepository;
        $this->HocSinhRepository = $HocSinhRepository;
    }

    public function store(Request $request,$id_hs)
    {
        $don_dan_thuoc =[];
        $don_dan_thuoc['hoc_sinh_id']  = $id_hs;
        $hoc_sinh = $this->HocSinhRepository->find($id_hs);
        $get_giao_vien = $hoc_sinh->getLop->GiaoVien()->get();
        if(count($get_giao_vien) == 0){
            return 'NoGiaoVien';
        }
        $don_dan_thuoc['ngay_bat_dau']  = Carbon::parse($request->dateFrom)->format('Y-m-d');
        $don_dan_thuoc['ngay_ket_thuc']  = Carbon::parse($request->dateTo)->format('Y-m-d');
        $don_dan_thuoc['noi_dung']  = $request->loinhan;
        $don_dan_thuoc['lop_id']  = $request->lop_id;
        
        $id = $this->QuanLyDonDanThuocRepository->create($don_dan_thuoc)->id;

        $don_thuoc= $request->donthuoc;
        foreach ($don_thuoc as $key => $value) {
            $chi_tiet_don_thuoc = [];
            $chi_tiet_don_thuoc['don_dan_thuoc_id']  = $id;
            $chi_tiet_don_thuoc['ten_thuoc']  = $value['name'];
            $chi_tiet_don_thuoc['don_vi']  = $value['donvi'];
            $chi_tiet_don_thuoc['lieu_luong']  =  $value['lieu'];
            $chi_tiet_don_thuoc['ghi_chu']  =  $value['note'];
            if(isset($value["anhImage"])){
                $anh = $value["anhImage"];
                $pathLoad = $anh->store('uploads/anh_thuoc');
                $chi_tiet_don_thuoc['anh'] = $request->getSchemeAndHttpHost().'/storage/'.$pathLoad; 
            }
            $this->ChiTietDonDanThuocRepository->create($chi_tiet_don_thuoc);
        };
        $link = [
            'route_name' => 'don-dan-thuoc',
        ];
        $route = json_encode($link);

        foreach ($get_giao_vien as $key => $data_giao_vien) {
            $thongbao=[];
            $thongbao['title'] ='Thông báo đơn dặn thuốc';
            $thongbao['content'] ='nội dung';
            $thongbao['route'] = $route;
            $thongbao['user_id'] = $data_giao_vien->user_id;
            $thongbao['role'] = 2;
            $thongbao['auth_id'] =$hoc_sinh->user_id;
            $this->NotificationRepository->create($thongbao);
        }
        return $thongbao;
    }
    public function getAll(){
        $don_thuoc =  $this->QuanLyDonDanThuocRepository->getAll();
        $don_thuoc->each(function ($item){
           $item->ChiTietDonDanThuoc;
       });
       return $don_thuoc;
    }

    public function getAllByIdHs($id_hs){
        $don_thuoc =  $this->QuanLyDonDanThuocRepository->getAllByIdHs($id_hs);
        $don_thuoc->each(function ($item){
           $item->ChiTietDonDanThuoc;
       });
       return $don_thuoc;
    }

    public function getDonThuocById($id){
         $item =  $this->QuanLyDonDanThuocRepository->find($id);
         $item->ChiTietDonDanThuoc;
         return $item;
    }

    public function getOneChiTietThuoc($id){
      return  $this->ChiTietDonDanThuocRepository->find($id);
    }
    
}
