<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\NoiDungThongBaoRepository;

class NoiDungThongBaoController extends Controller
{
    protected $NoiDungThongBaoRepository; 
    public function __construct(
        NoiDungThongBaoRepository $NoiDungThongBaoRepository
    )
    {
        $this->NoiDungThongBaoRepository = $NoiDungThongBaoRepository;
    }

    public function getNoiDungThongBaoId($id){
       return $this->NoiDungThongBaoRepository->find($id);
    }
}
