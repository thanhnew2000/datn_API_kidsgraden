<?php

namespace App\Http\Controllers\NamHoc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\NamHocRepository;
use Carbon\Carbon;

class NamHocController extends Controller
{
    public $NamHocRepository;
    public function __construct(NamHocRepository $NamHocRepository)
    {
        $this->NamHocRepository = $NamHocRepository;
    }
    
    public function getNamHocHienTai(){
        $namHienTai = $this->NamHocRepository->layNamHocHienTai();
        $arrDateStart = explode("-",$namHienTai->start_date);
        $arrDateEnd= explode("-",$namHienTai->end_date);
        $arr = [];
        // 0 là năm
        // 1 là tháng 
        // 2 là ngày
        if($arrDateStart[0] != $arrDateEnd[0]){
            for($i = $arrDateStart[1] ; $i <= 12 ; $i ++){
                array_push($arr,$i." / " .$arrDateStart[0]);
            };
            for($j = 1 ; $j <= $arrDateEnd[1] ; $j ++){
                array_push($arr,$j." / " .$arrDateEnd[0]);
            };
        }else{
            for($i = $arrDateStart[0] ; $i >= $arrDateEnd[1] ; $i ++){
                array_push($arr,$i." / ".$arrDateStart[0]);
            };
        }
       return $arr; 
    }
}
