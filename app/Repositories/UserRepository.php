<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseModelRepository;

class UserRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        User $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return User::class;
    }

    public function store()
    {
        return $this->model->get();
    }
    public function edit($id,$device){
        return  $this->model->where('id',$id)->update(['device' => $device]);
    }

    

}
