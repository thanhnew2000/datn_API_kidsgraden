<?php

namespace App\Repositories;

use App\Models\GiaoVien;
use App\Repositories\BaseModelRepository;

class GiaoVienRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        GiaoVien $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return GiaoVien::class;
    }

    public function store()
    {
        return $this->model->get();
    }


}
