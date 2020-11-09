<?php

namespace App\Repositories;

use App\Models\NamHoc;
use App\Repositories\BaseModelRepository;

class NamHocRepository  extends BaseModelRepository
{
    protected $model;
    public function __construct(
        NamHoc $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return NamHoc::class;
    }

    public function store()
    {
        return $this->model->get();
    }

    public function layNamHocHienTai()
    {
        return $this->model::where('type', 1)->first();
    }

   

}
