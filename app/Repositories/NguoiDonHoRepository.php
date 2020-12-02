<?php

namespace App\Repositories;

use App\Models\NguoiDonHo;
use App\Repositories\BaseModelRepository;

class NguoiDonHoRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        NguoiDonHo $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return NguoiDonHo::class;
    }

    public function store()
    {
        return $this->model->get();
    }

    public function getByIdHs($id){
        return $this->model->where('hoc_sinh_id',$id)->orderBy('id','desc')->get();
    }

}
