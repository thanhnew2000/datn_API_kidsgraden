<?php

namespace App\Repositories;

use App\Models\PhanHoiDonThuoc;
use App\Repositories\BaseModelRepository;

class PhanHoiDonThuocRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        PhanHoiDonThuoc $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return PhanHoiDonThuoc::class;
    }

    public function store()
    {
        return $this->model->get();
    }

    public function getBinhLuanOfDonThuoc($id){
        return $this->model->where('don_dan_thuoc_id',$id)->orderBy('created_at','asc')->get();
    }
}
