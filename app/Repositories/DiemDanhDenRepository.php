<?php

namespace App\Repositories;

use App\Models\DiemDanhDen;
use App\Repositories\BaseModelRepository;

class DiemDanhDenRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        DiemDanhDen $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return DiemDanhDen::class;
    }

    public function store()
    {
        return $this->model->get();
    }
    public function getDataByMonthYear($thang,$nam,$id_hs){
        return $this->model->where('hoc_sinh_id',$id_hs)->whereMonth('ngay_diem_danh_den',$thang)->whereYear('ngay_diem_danh_den',$nam)->get();
    }

 

    public function getDataOfMonth($firstDayOfMonth,$lastDayOfMonth){
        return $this->model->where('ngay_diem_danh_den', '>=',$firstDayOfMonth)
                           ->where('ngay_diem_danh_den', '<=', $lastDayOfMonth)
                           ->get();
    }
}
