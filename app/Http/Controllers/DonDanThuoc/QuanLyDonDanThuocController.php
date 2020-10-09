<?php

namespace App\Http\Controllers\DonDanThuoc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\QuanLyDonDanThuocRepository;
use App\Repositories\ChiTietDonDanThuocRepository;

use Storage;
use Carbon\Carbon;
class QuanLyDonDanThuocController extends Controller
{
    protected $QuanLyDonDanThuocRepository;
    protected $ChiTietDonDanThuocRepository;
    public function __construct(
        ChiTietDonDanThuocRepository $ChiTietDonDanThuocRepository,
        QuanLyDonDanThuocRepository $QuanLyDonDanThuocRepository
    )
    {
        $this->QuanLyDonDanThuocRepository = $QuanLyDonDanThuocRepository;
        $this->ChiTietDonDanThuocRepository = $ChiTietDonDanThuocRepository;
    }

    public function store(Request $request)
    {
        // return $request->all();
        $don_dan_thuoc =[];
        $don_dan_thuoc['phu_huynh_id']  = 1;
        $don_dan_thuoc['ngay_bat_dau']  = Carbon::parse($request->dateFrom)->format('Y-m-d');
        $don_dan_thuoc['ngay_ket_thuc']  = Carbon::parse($request->dateTo)->format('Y-m-d')  ;
        $don_dan_thuoc['noi_dung']  = $request->loinhan;
        $id = $this->QuanLyDonDanThuocRepository->create($don_dan_thuoc)->id;
        $don_thuoc= $request->donthuoc;
        
        foreach ($don_thuoc as $key => $value) {
            $chi_tiet_don_thuoc = [];
            $chi_tiet_don_thuoc['don_dan_thuoc_id']  = $id;
            $chi_tiet_don_thuoc['ten_thuoc']  = $value['name'];
            $chi_tiet_don_thuoc['don_vi']  = $value['donvi'];
            $chi_tiet_don_thuoc['lieu_luong']  =  $value['lieu'];
            $anh = $value["anhImage"];
            $pathLoad = $anh->store('public/uploads/anh_thuoc');
            $path =  $pathLoad;
            $chi_tiet_don_thuoc['anh'] = $path; 
            $this->ChiTietDonDanThuocRepository->create($chi_tiet_don_thuoc);
      
        };
       return 'thành công';
    }
}
