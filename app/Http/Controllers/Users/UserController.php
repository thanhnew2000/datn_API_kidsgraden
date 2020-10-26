<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
class UserController extends Controller
{
    protected $UserRepository;
    public function __construct(
        UserRepository $UserRepository
    )
    {
        $this->UserRepository = $UserRepository;
    }


    public function getOne(){
        $data =  $this->UserRepository->find(18);
        $data->HocSinh;
       return $data;
    }

}
