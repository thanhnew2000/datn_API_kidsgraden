<?php

namespace App\Repositories;

use App\Models\Album;
use App\Repositories\BaseModelRepository;

class AlbumRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        Album $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return Album::class;
    }

    public function getAlbumByLop($lop_id){
        $data = $this->model->where('lop_id',$lop_id)->get();
        for($i = 0 ; $i < count($data);$i++){
           $imageParse = json_decode($data[$i]['item_images']);
            if(isset($data[$i])){
                $data[$i]['first_image'] = $imageParse[0];
            }else{
                $data[$i]['first_image'] = '';
            }
        }
       return $data;
    }
    public function getFirstAlbumLop($lop_id)
    {
        $this->model->where('lop_id',$lop_id)->first();
    }


}
