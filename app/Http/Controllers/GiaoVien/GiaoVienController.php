<?php

namespace App\Http\Controllers\GiaoVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\GiaoVienRepository;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class GiaoVienController extends Controller
{
    protected $GiaoVienRepository;
    public function __construct(
        GiaoVienRepository $GiaoVienRepository
    )
    {
        $this->GiaoVienRepository = $GiaoVienRepository;
    }

    public function getGVbyIdLop($id){
        return DB::table('giao_vien')->where('lop_id',$id)->get();
    }
}
