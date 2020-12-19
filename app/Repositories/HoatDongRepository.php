<?php

namespace App\Repositories;

use App\Models\HoatDong;
use App\Repositories\BaseModelRepository;


class HoatDongRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        HoatDong $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return HoatDong::class;
    }

    public function getTable()
    {
        return 'hoat_dong';
    }

    public function getHoatDong($id_lop){
        return $this->model->where('lop_id',$id_lop)->where('type',2)->get();
    }

    public function getHoatDongByNam($id_lop,$nam){
        return $this->model->where('lop_id',$id_lop)->where('nam',$nam)->get();
    }
}
