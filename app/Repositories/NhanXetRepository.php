<?php

namespace App\Repositories;

use App\Models\NhanXet;
use App\Repositories\BaseModelRepository;

class NhanXetRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        NhanXet $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return NhanXet::class;
    }

    public function getNhanXetOfHs($id){
        return $this->model->where('hoc_sinh_id',$id)->orderBy('created_at','asc')->get();
    }

}
