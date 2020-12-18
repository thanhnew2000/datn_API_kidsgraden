<?php

namespace App\Repositories;

use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseModelRepository;

class NotificationRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        Notification $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return Notification::class;
    }

    public function createNotifications($data)
    {
        return Notification::create($data);
    }

    public function getNofiByIdUser($id_hs){
        return $this->model->where('id_hs',$id_hs)->limit(20)->orderBy('id','DESC')->get();
    }

    public function getNumberNotifiNumberOneHs($id_hs){
        return $this->model->where('id_hs',$id_hs)->where('bell',1)->selectRaw("count(*) as number")->get();
    }

    public function getMoreThongBaoHs($id_hs){
        return $this->model->where('id_hs',$id_hs)->limit(70)->orderBy('id','DESC')->get();
    }

    public function updateBellHs($id_hs)
    {
        $arr_hs = $this->model->where('id_hs',$id_hs)->select('id')->get();
            foreach($arr_hs as $hs){
                $this->model->find($hs->id)->update(['bell'=>2]);
            }
    }

    public function updateTypeOneNotifi($id_notification)
    {
         return $this->model->find($id_notification)->update(['type'=>2]);
    }


    public function getNotifiHsBell1($id)
    {
           $hs_bell = $this->model->where('id_hs',$id)->where('bell',1)->get();
           return $hs_bell;
    }

    public function getAllNotifiByUser($id_nguoi_nhan){
        $data = $this->model->
        where('user_id',$id_nguoi_nhan)->where('role',1)
        ->select(
            DB::raw(
                '*,
                YEAR(created_at) as year,
                MONTH(created_at) as month',
            ))
         ->get();

         $thangNam = $this->model
         ->where('user_id',$id_nguoi_nhan)->where('role',1)
         ->select(
             DB::raw(
                 'YEAR(created_at) as year,
                 MONTH(created_at) as month',
             ))
          ->groupBy('year','month')
          ->get();

        $result = [];
        for($i = 0; $i < count($thangNam); $i++){
            $arrTn = [];
            for($j = 0; $j < count($data);$j++){
                if( ($thangNam[$i]->year == $data[$j]->year) && ($thangNam[$i]->month == $data[$j]->month)){
                    array_push($arrTn,$data[$j]);
                }
            }
            $result[$thangNam[$i]->year.'-'.$thangNam[$i]->month] = $arrTn ;
        }
        return  $result;
 
    }
}