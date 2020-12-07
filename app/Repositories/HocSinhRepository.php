<?php

namespace App\Repositories;

use App\Models\HocSinh;
use App\Repositories\BaseModelRepository;

class HocSinhRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        HocSinh $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return HocSinh::class;
    }

    public function store()
    {
        return $this->model->get();
    }

    public function getAllHsByIdUser($id){
        return $this->model->where('user_id',$id)->where('type',1)->get();
    }

}
