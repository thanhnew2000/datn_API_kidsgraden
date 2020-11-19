<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use QuanVT\Firebase\SyncWithFirebase;

class Notification extends Model
{
    use Notifiable, SyncWithFirebase;

    protected $table = 'notification';
    protected $fillable = ['title', 'content', 'route', 'id_nguoi_nhan', 'auth_id', 'type', 'bell','role'];
}