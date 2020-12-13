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
        $id_hs = $request->id_hs;


        $thang_da_cat = trim($arrDate[0]," ' ");
        if($thang_da_cat < 10){
            $thang = '0'.$thang_da_cat;
        }else{
            $thang = $thang_da_cat;
        }
        $nam = trim($arrDate[1]," ' ");
        $nam_thang_loi =  $nam.'-'.$thang;
        $nam_thang = str_replace("'",'',$nam_thang_loi);

        $thangNamTiep = $nam_thang.'-';
        
        $dt = new Carbon($nam_thang);
        $firstDayMonth = $dt->firstOfMonth()->format('d');
        $lastDayMonth = $dt->lastOfMonth()->format('d');
        $dataDen =  $this->DiemDanhDenRepository->getDataOfMonth($thangNamTiep.$firstDayMonth,$thangNamTiep.$lastDayMonth,$id_hs);
        $dataVe =  $this->DiemDanhVeRepository->getDataOfMonth($thangNamTiep.$firstDayMonth,$thangNamTiep.$lastDayMonth,$id_hs);

        if(count($dataDen) == 0 && count($dataVe) == 0){
            return 'NoHaveData';
        }
       
        $dataVe->each(function ($item){
            if($item->NguoiDonHo !== null){
                $item->NguoiDonHo;
            }
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
                if($dataDen[$j]['ngay_diem_danh_den'] == $thangNamTiep.$key){ 
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
                    if($dataVe[$j]['ngay_diem_danh_ve'] == $thangNamTiep.$key){
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

}
