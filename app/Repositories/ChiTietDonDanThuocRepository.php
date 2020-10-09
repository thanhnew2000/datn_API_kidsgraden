<?php

namespace App\Repositories;

use App\Models\ChiTietDonDanThuoc;
use App\Repositories\BaseModelRepository;

class ChiTietDonDanThuocRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        ChiTietDonDanThuoc $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return ChiTietDonDanThuoc::class;
    }

    // public function store()
    // {
    //     $this
    //     return $this->model->get();
    // }


}
