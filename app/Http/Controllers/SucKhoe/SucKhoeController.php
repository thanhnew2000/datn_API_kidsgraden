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
    public function getSucKhoeHs($nam){
        return $this->SucKhoeRepository->getSucKhoeHs(451,$nam);
    }

    public function getAllSucKhoeHs($id){
        return $this->SucKhoeRepository->getAllSucKhoeHs($id);
    }

    public function getNamHaveDataSucKhoeHs(){
        return $this->SucKhoeRepository->getNamHaveDataSucKhoeHs(451);
    }
}
