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
    public function updateTypeOneNotifi($id_notification)
    {
        return $this->NotificationRepository->updateTypeOneNotifi($id_notification);
    }
    public function updateBellHs($id_hs)
    {
        return $this->NotificationRepository->updateBellHs($id_hs);
    }

    public function getArrNotifiNumberHs(Request $request)
    {
        $arr_id = $request->arr_id_hs;
        $number=[];
        foreach($arr_id as $id){
           $hs_bell = $this->NotificationRepository->getNotifiHsBell1($id);
           $tong_noti = count($hs_bell);
           $array_ = [ 'id_hs' => $id, 'number' =>$tong_noti];
           array_push($number,$array_);
        }
        return $number;
    }
    

}
