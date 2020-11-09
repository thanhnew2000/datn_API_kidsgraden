<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DotKhamSucKhoe extends Model
{
    protected $table = 'dot_kham_suc_khoe';
    protected $fillable = [
        'id',
        'ten_dot',
        'thoi_gian',
    ];
}
