<?php

namespace App\Http\Controllers\DonDanThuoc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\QuanLyDonDanThuocRepository;
use Storage;
use Illuminate\Support\Facades\DB;
class QuanLyDonDanThuocController extends Controller
{
    protected $QuanLyDonDanThuocRepository;
    public function __construct(
        QuanLyDonDanThuocRepository $QuanLyDonDanThuocRepository
    )
    {
        $this->QuanLyDonDanThuocRepository = $QuanLyDonDanThuocRepository;
    }

    public function index(Request $request)
    {
        $data =  $request->all();

        
        // $anh = $data['donthuoc'][0]['anhImage'];

        // $data['name'];
        // $data['name'];

        // $pathLoad = $anh->store('public/uploads/Thuoc');
        // DB::table('don_dan_thuoc')->insert(
        //     ['phu_huynh_id' => '1', 'hoc_sinh_id' =>'1', 'noi_dung'=>'hihi','trang_thai'=>'1','ngay_bat_dau'=>'2020-10-20','ngay_ket_thuc'=>'2020-10-20']
        // );
        return $data;
    }

    public function getAll(){
        $data =    DB::table('don_dan_thuoc')->get();
        return $data;
    }
    
}
