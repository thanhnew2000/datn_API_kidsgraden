<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoiDungThongBao extends Model
{
    protected $table = 'noi_dung_thong_bao';
    protected $fillable = [
        'id',
        'title',
        'content',
        'auth_id',
        'type',
        'isShow',
        'created_at',
        'updated_at',
    ];
}
