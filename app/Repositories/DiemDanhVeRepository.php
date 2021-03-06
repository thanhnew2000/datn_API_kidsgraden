<?php

namespace App\Repositories;

use App\Models\DiemDanhVe;
use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;

class DiemDanhVeRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        DiemDanhVe $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return DiemDanhVe::class;
    }

    public function store()
    {
        return $this->model->get();
    }
    public function getDataByMonthYear($thang,$nam,$id_hs){
        return $this->model->where('hoc_sinh_id',$id_hs)->whereMonth('ngay_diem_danh_ve',$thang)->whereYear('ngay_diem_danh_ve',$nam)->get();
    }

    public function testQuery(){
        $data = $this->model
        ->select(
            DB::raw(
                '*,
                YEAR(ngay_diem_danh_ve) as year,
                MONTH(ngay_diem_danh_ve) as month',
            ))
         ->get();

         $thangNam = $this->model
         ->select(
             DB::raw(
                 'YEAR(ngay_diem_danh_ve) as year,
                 MONTH(ngay_diem_danh_ve) as month',
             ))
          ->groupBy('year','month')
          ->get();

        $result = [];
        for($i = 0; $i < count($thangNam); $i++){
            $arrTn = [];
            for($j = 0; $j < count($data);$j++){
                if( ($thangNam[$i]->year == $data[$j]->year) && ($thangNam[$i]->month == $data[$j]->month)){
                    array_push($arrTn,$data[$j]);
                }
            }
            $result[$thangNam[$i]->year.'-'.$thangNam[$i]->month] = $arrTn ;
        }
        return  $result;
    }

    
    public function getDataOfMonth($firstDayOfMonth,$lastDayOfMonth,$id_hs){
        return $this->model->where('hoc_sinh_id',$id_hs)
                           ->where('ngay_diem_danh_ve', '>=',$firstDayOfMonth)
                           ->where('ngay_diem_danh_ve', '<=', $lastDayOfMonth)
                           ->orderBy('ngay_diem_danh_ve', 'ASC')
                           ->get();
    }
}
