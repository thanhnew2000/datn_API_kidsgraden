<?php

namespace App\Repositories;

use App\Models\NoiDungThongBao;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseModelRepository;

class NoiDungThongBaoRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        NoiDungThongBao $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return NoiDungThongBao::class;
    }


}