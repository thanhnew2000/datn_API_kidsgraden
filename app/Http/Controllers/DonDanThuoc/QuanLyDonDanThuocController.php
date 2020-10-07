<?php

namespace App\Http\Controllers\DonDanThuoc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\QuanLyDonDanThuocRepository;
use Storage;
class QuanLyDonDanThuocController extends Controller
{
    protected $QuanLyDonDanThuocRepository;
    public function __construct(
        QuanLyDonDanThuocRepository $QuanLyDonDanThuocRepository
    )
    {
        $this->QuanLyDonDanThuocRepository = $QuanLyDonDanThuocRepository;
    }

    public function index(Request $request)
    {
        $anh = $request->file("file");
        $pathLoad = $anh->store('public/uploads/anh_gv');
        $path =  $pathLoad;
        $dataRequest['anh'] = $path;   
        return 'thành công';
    }
}
