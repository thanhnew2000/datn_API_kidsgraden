<?php

namespace App\Http\Controllers\PhanHoiDanThuoc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhanHoiDanThuocController extends Controller
{
    public function store(Request $request, $id){
        $data =  $request->all();
        $data['type'] = 1;
    }
}
