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

    public function getNofiByIdUser($id_nguoi_nhan){
        return $this->model->where('id_nguoi_nhan',$id_nguoi_nhan)->where('role',3)->limit(15)->get();
    }

    public function getAllNotifiByUser($id_nguoi_nhan){
        $data = $this->model->
        where('id_nguoi_nhan',$id_nguoi_nhan)->where('role',3)
        ->select(
            DB::raw(
                '*,
                YEAR(created_at) as year,
                MONTH(created_at) as month',
            ))
         ->get();

         $thangNam = $this->model
         ->where('id_nguoi_nhan',$id_nguoi_nhan)->where('role',3)
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