<?php

namespace App\Http\Controllers\HoatDong;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\HoatDongRepository;

class HoatDongController extends Controller
{
    protected $HoatDongRepository;
    public function __construct(
        HoatDongRepository $HoatDongRepository
    )
    {
        $this->HoatDongRepository = $HoatDongRepository;
    }

    public function getHoatDong($id_lop){
        return $this->HoatDongRepository->getHoatDong($id_lop);
    }

    public function getHoatDongByNam($id_lop,$nam){
        return $this->HoatDongRepository->getHoatDongByNam($id_lop,$nam);
    }
}
