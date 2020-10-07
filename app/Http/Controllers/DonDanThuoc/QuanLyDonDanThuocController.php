<?php

namespace App\Http\Controllers\DonDanThuoc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\QuanLyDonDanThuocRepository;

class QuanLyDonDanThuocController extends Controller
{
    protected $QuanLyDonDanThuocRepository;
    public function __construct(
        QuanLyDonDanThuocRepository $QuanLyDonDanThuocRepository
    )
    {
        $this->QuanLyDonDanThuocRepository = $QuanLyDonDanThuocRepository;
    }

    public function index()
    {
       $this->QuanLyDonDanThuocRepository->store();
    }
}
