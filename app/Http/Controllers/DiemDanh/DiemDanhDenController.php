<?php

namespace App\Http\Controllers\DiemDanh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\DiemDanhDenRepository;
use App\Repositories\DiemDanhVeRepository;

class DiemDanhDenController extends Controller
{
    protected $DiemDanhDenRepository;
    protected $DiemDanhVeRepository;
    public function __construct(
        DiemDanhDenRepository $DiemDanhDenRepository,
        DiemDanhVeRepository $DiemDanhVeRepository
    )
    {
        $this->DiemDanhDenRepository = $DiemDanhDenRepository;
        $this->DiemDanhVeRepository = $DiemDanhVeRepository;
    }

    public function getDataByThangNam(Request $request){
        $arrDate = explode(' / ',$request->date);
        $thang = $arrDate[0];
        $nam = $arrDate[1];
        $den = $this->DiemDanhDenRepository->getDataByMonthYear($thang,$nam);
        $ve =  $this->DiemDanhVeRepository->getDataByMonthYear($thang,$nam);
        return [
            'diem_danh_den' => $den,
            'diem_danh_ve' => $ve,
        ];
    }

    public function testQuery(){
       $datas= $this->DiemDanhVeRepository->testQuery();
       return $datas;
    }
}
