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
    public function getDataByMonthYear($thang,$nam){
        return $this->model->whereMonth('ngay_diem_danh_den',$thang)->whereYear('ngay_diem_danh_den',$nam)->get();
    }


}
