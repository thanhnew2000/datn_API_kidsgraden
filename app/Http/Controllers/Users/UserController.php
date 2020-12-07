<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Str;


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
        if(isset($request->new_password)){
             $this_user = $this->UserRepository->find($id);
             if (!(Hash::check($request->get('current_password'), $this_user->password))) {
               return 'NoCorrectPass';
            }
            if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
                return 'CoincidNewPassWithOldPass';
            }
            $data['password'] = Hash::make($request->new_password);

        }else{
            $data = $request->all();
        }
       return $this->UserRepository->update($id,$data); 
    }
    public function updateOnlyDevice($id){
        return $this->UserRepository->update($id,['device'=> null]); 
    }
    // forgot password
    public function sendMaOTP(Request $request){
        $email = $request->email;
        $checkUser = User::where('email', $email)->first();
        if($checkUser !== null){
            $ma_otp = random_int(0,9).random_int(0,9).random_int(0,9).
            random_int(0,9).random_int(0,9);
            $checkUser->time_code   = Carbon::now();
            $checkUser->ma_otp      = $ma_otp;
            $checkUser->token       = Str::random(60).md5(time());
            $checkUser->save();

            $HostDomain = 'https://smsgateway.rbsoft.org/services/send.php?';
            $key        = 'AAAA0i5VEtw:APA91bGn6K6XM-GK2RHqFVi7W3Iz3JqLcCrz7wgmfI2Ab2TcKWn1fzdyDJumPtmEaR7NP2udSTBEGKbhIyuO46jPF_hrB9MSPkgo9KnO-mqBy6kAmNtPFq60hLUAUVwT8Ul_5LWvWUvB';
            $devices    = 'fcb73f2e5223742deac6eff10997c8a58755e956';
            $number     = $checkUser->phone_number;
            $Api_SMS    = $HostDomain .'key=' . $key .'&number=' . $number .'&message='. 
                          $ma_otp . '+l%C3%A0+m%C3%A3+x%C3%A1c+nh%E1%BA%ADn+c%E1%BB%A7a+b%E1%BA%A1n&devices=' . $devices;
            
            $response   = Http::get($Api_SMS);
            $result     = $response->json();
            return $result;

        }else{
            return 'NoHaveAccount';
        }


    }


}
