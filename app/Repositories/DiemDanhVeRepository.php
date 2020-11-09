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
    public function getDataByMonthYear($thang,$nam){
        return $this->model->whereMonth('ngay_diem_danh_ve',$thang)->whereYear('ngay_diem_danh_ve',$nam)->get();
    }

    public function testQuery(){
        return 
        // DB::table('diem_danh_ve as dd1')
        // ->join('diem_danh_ve as dd2', function ($join) {
        //     $join->on('dd1.id', '=', 'dd2.id')
        //          ->where(DB::raw('YEAR(dd1.ngay_diem_danh_ve)'), '>=', DB::raw('YEAR(dd2.ngay_diem_danh_ve)'))
        //          ->select(
        //             DB::raw(
        //              'YEAR(dd1.ngay_diem_danh_ve) as year1,
        //               MONTH(dd1.ngay_diem_danh_ve) as month1')
        //          )->groupBy('year');

        // })
        //  ->get();
        DB::table('diem_danh_ve as dd1')
        ->select(
            DB::raw(
                'YEAR(dd1.ngay_diem_danh_ve) as year1,
                MONTH(dd1.ngay_diem_danh_ve) as month1',
                DB::raw(''),
            ))
         ->groupBy('year1')
         ->get();
    }

}
