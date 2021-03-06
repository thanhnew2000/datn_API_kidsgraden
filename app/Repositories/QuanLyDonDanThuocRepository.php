<?php

namespace App\Repositories;

use App\Models\DonDanThuoc;
use App\Repositories\BaseModelRepository;

class QuanLyDonDanThuocRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        DonDanThuoc $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return DonDanThuoc::class;
    }

    public function store()
    {
        return $this->model->get();
    }
    public function getAllByIdHs($id_hs){
        return $this->model->where('hoc_sinh_id',$id_hs)->get();
    }

}
