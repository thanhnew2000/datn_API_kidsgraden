<?php

namespace App\Http\Controllers\DiemDanh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\DiemDanhDenRepository;
use App\Repositories\DiemDanhVeRepository;
use Carbon\Carbon;

class DiemDanhController extends Controller
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
        if($arrDate[0] < 10){
            $thang = '0'.$arrDate[0];
        }else{
            $thang = $arrDate[0];
        }
        $nam = $arrDate[1];
        $thangNam =  $nam.'-'.$thang.'-';
        // return $thangNam;
        // $id_hs = $request->id_hs;
        // $den = $this->DiemDanhDenRepository->getDataByMonthYear($thang,$nam,$id_hs);
        // $ve =  $this->DiemDanhVeRepository->getDataByMonthYear($thang,$nam,$id_hs);
        // return [
        //     'diem_danh_den' => $den,
        //     'diem_danh_ve' => $ve,
        // ];

        $dt = new Carbon($nam.'-'.$thang);
        $firstDayMonth = $dt->firstOfMonth()->format('d');
        $lastDayMonth = $dt->lastOfMonth()->format('d');
        $dataDen =  $this->DiemDanhDenRepository->getDataOfMonth($thangNam.$firstDayMonth,$thangNam.$lastDayMonth);
        $dataVe =  $this->DiemDanhVeRepository->getDataOfMonth($thangNam.$firstDayMonth,$thangNam.$lastDayMonth);

        if(count($dataDen) == 0 && count($dataVe) == 0){
            return 'NoHaveData';
        }
       
        $dataVe->each(function ($item){
            $item->NguoiDonHo;
        });

        $arrDen = [];
        $arrVe = [];
        for($i = $firstDayMonth ;$i <= $lastDayMonth ; $i++){
            $key=$i;
            if(strlen($i) == 1){
                $key = '0'.$i;
            };

            $ngayDen['ngay'] =  $key;
            $ngayDen['sang'] = 0;
            $ngayDen['chieu'] = 0;
            $ngayDen['an'] = 0;
            $ngayDen['detail'] = [];

            $ngayVe['ngay'] = $key;
            $ngayVe['data'] = 0;
            for($j = 0 ;$j < count($dataDen) ; $j++){
                if($dataDen[$j]['ngay_diem_danh_den'] == $thangNam.$key){ 
                    if($dataDen[$j]['type'] == 1){
                        $ngayDen['sang'] = $dataDen[$j]['trang_thai'];
                        $ngayDen['detail']['sang'] =  $dataDen[$j];
                    }else if($dataDen[$j]['type'] == 2){
                        $ngayDen['chieu'] = $dataDen[$j]['trang_thai'];
                        $ngayDen['an'] =  $dataDen[$j]['phieu_an'];
                        $ngayDen['detail']['chieu'] =  $dataDen[$j];
                    }
                }

                // ko for ngày về vì dataDen mà ko có dữ liệu ngày thì này dataVe cũng ko có
                if(isset($dataVe[$j])){
                    if($dataVe[$j]['ngay_diem_danh_ve'] == $thangNam.$key){
                        $ngayVe['data'] = $dataVe[$j];
                    }
                }

            }
                array_push($arrDen,$ngayDen);
                array_push($arrVe,$ngayVe);
                
        }

      
        $arrdata = ['diem_danh_den' => $arrDen, 'diem_danh_ve' => $arrVe];
        return  $arrdata;
    }


    

    public function testQuery(){
       $datas= $this->DiemDanhVeRepository->testQuery();
       return $datas;
    }



    
    public function testQuery2(){
        $dt = new Carbon('2020-11');
        $firstDayMonth = $dt->firstOfMonth()->format('d');
        $lastDayMonth = $dt->lastOfMonth()->format('d');
        $dataDen =  $this->DiemDanhDenRepository->getDataOfMonth('2020-11-'.$firstDayMonth,'2020-11-'.$lastDayMonth);
        $dataVe =  $this->DiemDanhVeRepository->getDataOfMonth('2020-11-'.$firstDayMonth,'2020-11-'.$lastDayMonth);
       
        $dataVe->each(function ($item){
            $item->NguoiDonHo;
        });

        $arrDen = [];
        $arrVe = [];
        for($i = $firstDayMonth ;$i <= $lastDayMonth ; $i++){
            $key=$i;
            if(strlen($i) == 1){
                $key = '0'.$i;
            };

            $ngayDen['ngay'] =  $key;
            $ngayDen['sang'] = 0;
            $ngayDen['chieu'] = 0;
            $ngayDen['an'] = 0;
            $ngayDen['detail'] = [];

            $ngayVe['ngay'] = $key;
            $ngayVe['data'] = 0;
            for($j = 0 ;$j < count($dataDen) ; $j++){
                if($dataDen[$j]['ngay_diem_danh_den'] == '2020-11-'.$key){ 
                    if($dataDen[$j]['type'] == 1){
                        $ngayDen['sang'] = $dataDen[$j]['trang_thai'];
                        $ngayDen['detail']['sang'] =  $dataDen[$j];
                    }else if($dataDen[$j]['type'] == 2){
                        $ngayDen['chieu'] = $dataDen[$j]['trang_thai'];
                        $ngayDen['an'] =  $dataDen[$j]['phieu_an'];
                        $ngayDen['detail']['chieu'] =  $dataDen[$j];
                    }
                }

                // ko for ngày về vì dataDen mà ko có dữ liệu ngày thì này dataVe cũng ko có
                if(isset($dataVe[$j])){
                    if($dataVe[$j]['ngay_diem_danh_ve'] == '2020-11-'.$key){
                        $ngayVe['data'] = $dataVe[$j];
                    }
                }

            }
                array_push($arrDen,$ngayDen);
                array_push($arrVe,$ngayVe);
                
        }

      
        $arrdata = ['diem_danh_den' => $arrDen, 'diem_danh_ve' => $arrVe];
        return  $arrdata;

     }
}
