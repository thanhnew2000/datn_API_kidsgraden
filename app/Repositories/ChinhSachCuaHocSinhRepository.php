<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\ChinhSachCuaHocSinh;

class ChinhSachCuaHocSinhRepository extends BaseModelRepository {

    protected $model;
    public function __construct(
        ChinhSachCuaHocSinh $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getModel()
    {
        return ChinhSachCuaHocSinh::class;
    }

    public function deleteList($array)
    {
        $this->model->destroy($array);
    }

    public function maxMienGiam($id_hoc_sinh)
    {
        $thong_tin_hoc_sinh_chinh_sach =  $this->model->where('id_hoc_sinh',$id_hoc_sinh)->get()->each->DoiTuongChinhSach->toArray();
        $array_chinh_sach= [];
        foreach ($thong_tin_hoc_sinh_chinh_sach as $key => $value) {
            array_push($array_chinh_sach,$value['doi_tuong_chinh_sach']);
        }
        $numbers = array_column($array_chinh_sach, 'muc_mien_giam');
        return max($numbers);
    }
   


    

    
}