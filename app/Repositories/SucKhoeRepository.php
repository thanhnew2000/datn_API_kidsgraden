<?php

namespace App\Repositories;

use App\Models\SucKhoe;
use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;

class SucKhoeRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        SucKhoe $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return SucKhoe::class;
    }

    public function getTable()
    {
        return 'suc_khoe';
    }

    public function store()
    {
        return $this->model->get();
    }

    public function getSucKhoeHs($id_hs,$nam){
        $data = $this->model
        ->join('dot_kham_suc_khoe', 'dot_kham_suc_khoe.id', '=', 'suc_khoe.dot_id')
        ->where('suc_khoe.hoc_sinh_id', '=', $id_hs)
        ->whereYear('dot_kham_suc_khoe.thoi_gian', '=', $nam)
        ->get();
        return $data;
    }

    public function getAllSucKhoeHs($id_hs){
        $data = $this->model
        ->join('dot_kham_suc_khoe', 'dot_kham_suc_khoe.id', '=', 'suc_khoe.dot_id')
        ->where('suc_khoe.hoc_sinh_id', '=', $id_hs)
        ->orderBy('dot_kham_suc_khoe.thoi_gian','asc')
        ->get();
        return $data;
    }


    public function getNamHaveDataSucKhoeHs($id_hs){
        $data = $this->model
        ->join('dot_kham_suc_khoe', 'dot_kham_suc_khoe.id', '=', 'suc_khoe.dot_id')
        ->where('suc_khoe.hoc_sinh_id', '=', $id_hs)
        ->select(DB::raw('YEAR(dot_kham_suc_khoe.thoi_gian) as year'))
        ->orderBy('year','ASC')
        ->groupBy('year')
        ->get();
        return $data;
    }
    

 

}
