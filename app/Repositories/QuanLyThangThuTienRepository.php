<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\ThangThuTien;

class QuanLyThangThuTienRepository extends BaseModelRepository {

    protected $model;
    public function __construct(
        ThangThuTien $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getModel()
    {
        return ThangThuTien::class;
    }

    public function getDotThuFromArrDot($arr){
        return $this->model->whereIn('id',$arr)->get();
    }
 
    public function get_nam_from_arr_thang_thu($arr){
        return $this->model->whereIn('id',$arr)->select('id_nam_hoc')->groupBy('id_nam_hoc')->get();
    }
    public function get_thang_thu_from_arr_thang_thu($arr){
        return $this->model->whereIn('id',$arr)->get();
    }
    


    

    
}