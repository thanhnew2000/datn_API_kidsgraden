<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
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

    public function edit(Request $request){
       return $this->UserRepository->edit($request->id,$request->device);
    }

    public function update(Request $request,$id){
        $data = [];
        if(isset($request->password)){
             $data['password'] = Hash::make($request->password);
             $this_user = $this->UserRepository->find($id);
             if(Hash::check($request->oldPassword,$this_user->password)){
                 return 'NoCorrectPass';
             }
        }else{
            $data = $request->all();
        }
       return $this->UserRepository->update($id,$data); 
    }
}
