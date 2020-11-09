<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoatDong extends Model
{
    protected $table = "hoat_dong";
    protected $fillable = [
        'id',
        'id_gv',
        'tuan',
        'nam',
        'link_file_hd',
        'type',
    ];
}
