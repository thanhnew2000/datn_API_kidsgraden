<?php

namespace App\Repositories;

use App\Models\DonNghiHoc;
use App\Repositories\BaseModelRepository;

class XinNghiHocRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        DonNghiHoc $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return DonNghiHoc::class;
    }

    public function store()
    {
        return $this->model->get();
    }
    public function getAllByIdHs($id){
        return $this->model->where('hoc_sinh_id',$id)->get();
    }

}
