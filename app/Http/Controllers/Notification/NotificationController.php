<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\NotificationRepository;

class NotificationController extends Controller
{
    protected $NotificationRepository; 
    public function __construct(
        NotificationRepository $NotificationRepository
    )
    {
        $this->NotificationRepository = $NotificationRepository;
    }

    public function getNofiByIdUser($id_nguoi_nhan){
        return $this->NotificationRepository->getNofiByIdUser($id_nguoi_nhan);
    }

    public function getAllNotifiByUser($id_nguoi_nhan){
        return $this->NotificationRepository->getAllNotifiByUser($id_nguoi_nhan);

    }
    public function updateTypeOrBellHs($id_hs,$status)
    {
        return $this->NotificationRepository->updateTypeOrBellHs($id_hs,$status);
    }
    

}
