<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NguoiDonHo extends Model
{
    protected $table = 'nguoi_don_ho';
    protected $fillable = [
        'id',
        'phone_number',
        'date_start',
        'date_end',
        'anh_nguoi_don_ho',
        'ten_nguoi_don_ho',
        'ghi_chu',
        'cmtnd',
        'hoc_sinh_id',
    ];
}
