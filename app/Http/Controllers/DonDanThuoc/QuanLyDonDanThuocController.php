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

    public function store(Request $request,$id_hs)
    {
        // return $request->all();
        $don_dan_thuoc =[];
        $don_dan_thuoc['hoc_sinh_id']  = $id_hs;
        $don_dan_thuoc['ngay_bat_dau']  = Carbon::parse($request->dateFrom)->format('Y-m-d');
        $don_dan_thuoc['ngay_ket_thuc']  = Carbon::parse($request->dateTo)->format('Y-m-d')  ;
        $don_dan_thuoc['noi_dung']  = $request->loinhan;
        return   $don_dan_thuoc ;
        
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
                $chi_tiet_don_thuoc['anh'] = $pathLoad; 
            }
            $this->ChiTietDonDanThuocRepository->create($chi_tiet_don_thuoc);
      
        };
       return 'thành công';
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

    public function getOneChiTietThuoc($id){
      return  $this->ChiTietDonDanThuocRepository->find($id);
    }
    
}
