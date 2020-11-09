<?php

namespace App\Http\Controllers\DiemDanh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\DiemDanhVeRepository;

class DiemDanhVeController extends Controller
{
    protected $DiemDanhVeRepository;
    public function __construct(
        DiemDanhVeRepository $DiemDanhVeRepository
    )
    {
        $this->DiemDanhVeRepository = $DiemDanhVeRepository;
    }

}
