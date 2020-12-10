<?php

namespace App\Http\Controllers\SucKhoe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SucKhoeRepository;

class SucKhoeController extends Controller
{
    protected $SucKhoeRepository;
    public function __construct(
        SucKhoeRepository $SucKhoeRepository
    )
    {
        $this->SucKhoeRepository = $SucKhoeRepository;
    }
        // CHUA DUNG
    public function getSucKhoeHs($id_hs,$nam){
        return $this->SucKhoeRepository->getSucKhoeHs($id_hs,$nam);
    }
        // 
    
    public function getAllSucKhoeHs($id_hs){
        return $this->SucKhoeRepository->getAllSucKhoeHs($id_hs);
    }
    public function getNamHaveDataSucKhoeHs($id_hs){
        return $this->SucKhoeRepository->getNamHaveDataSucKhoeHs($id_hs);
    }
}
