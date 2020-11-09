<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NamHoc extends Model
{
    protected $table = 'nam_hoc';
    protected $fillable = [
        'name', 'start_date', 'end_date','backup','type'
    ];
}
