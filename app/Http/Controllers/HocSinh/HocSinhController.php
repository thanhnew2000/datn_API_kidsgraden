<?php

namespace App\Http\Controllers\HocSinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\HocSinhRepository;
use Illuminate\Support\Facades\DB;
class HocSinhController extends Controller
{
    protected $HocSinhRepository;
    public function __construct(
        HocSinhRepository $HocSinhRepository
    )
    {
        $this->HocSinhRepository = $HocSinhRepository;
    }

    public function edit(Request $request, $id){
        $data =  $request->all();
        return $this->HocSinhRepository->update($id,$data);
    }
    public function getOne($id){
        $data = $this->HocSinhRepository->find($id);
        if($data->getLop !== null){
            $data->getLop;
        }
        return $data;
    }
    public function getAllHsByIdUser($id){
        $data = $this->HocSinhRepository->getAllHsByIdUser($id);
        $data->each(function ($item){
            if($item->getLop !== null){
                $item->getLop;
            }
        });
        return $data;
    }
}
