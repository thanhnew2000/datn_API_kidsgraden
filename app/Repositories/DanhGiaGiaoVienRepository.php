<?php

namespace App\Repositories;

use App\Models\DanhGiaGiaoVien;
use App\Repositories\BaseModelRepository;

class DanhGiaGiaoVienRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        DanhGiaGiaoVien $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return DanhGiaGiaoVien::class;
    }

    public function store()
    {
        return $this->model->get();
    }


}
