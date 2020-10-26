<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    protected $table = 'lop_hoc';
    protected $fillable = [
        'id',
        'khoi_id',
        'ten_lop',
    ];
}
