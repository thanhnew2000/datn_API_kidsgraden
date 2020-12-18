<?php

namespace App\Http\Controllers\NhanXet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\NhanXetRepository;

class NhanXet extends Controller
{
    protected $NguoiDonHoRepository;
    public function __construct(
        NhanXetRepository $NhanXetRepository
    )
    {
        $this->NhanXetRepository = $NhanXetRepository;
    }
    public function getNhanXetOfHs($id_hs){
        $data = $this->NhanXetRepository->getNhanXetOfHs($id_hs);
        $data->each(function ($item){
            // if($item->GiaoVien !== null){
                $item->GiaoVien;
            // }
        });
        return $data;   
    }
    public function getOneId($id){
        $data = $this->NhanXetRepository->find($id);
        $data->GiaoVien;
        return $data;
    }
}
