<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HocSinh;
class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'id',
        'name',
        'avatar',
        'email',
    ];

    public function HocSinh()
    {
        return $this->hasOne(HocSinh::class,'user_id','id');
    }
}
