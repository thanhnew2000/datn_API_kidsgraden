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
        return $this->model->where('user_id',$id_nguoi_nhan)->where('role',2)->limit(15)->get();
    }

    public function updateTypeOrBellHs($id_hs,$status)
    {
        $arr_hs = $this->model->where('user_id',$id_hs)->where('role',2)->select('id')->get();
        if($status == 1 ){
            foreach($arr_hs as $hs){
                $this->model->find($hs->id)->update(['type'=>2]);
            }
        }else{
            foreach($arr_hs as $hs){
                $this->model->find($hs->id)->update(['bell'=>2]);
            }
        }
    }

    public function getAllNotifiByUser($id_nguoi_nhan){
        $data = $this->model->
        where('user_id',$id_nguoi_nhan)->where('role',2)
        ->select(
            DB::raw(
                '*,
                YEAR(created_at) as year,
                MONTH(created_at) as month',
            ))
         ->get();

         $thangNam = $this->model
         ->where('user_id',$id_nguoi_nhan)->where('role',2)
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