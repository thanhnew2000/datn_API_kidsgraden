<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\User;
use stdClass;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;

class ForgotPassword extends Controller
{
    protected $UserRepository;
    public function __construct(
        UserRepository $UserRepository
    )
    {
        $this->UserRepository = $UserRepository;
    }

    public function sendMaOTP(Request $request){
        $username = trim($request->username);
        $checkUser = User::where('username',$username)->first();
        if($checkUser !== null){
            $ma_otp = random_int(0,9).random_int(0,9).random_int(0,9).
            random_int(0,9).random_int(0,9);
            $checkUser->time_code   = Carbon::now();
            $checkUser->ma_otp      = $ma_otp;
            $checkUser->token       = Str::random(60).md5(time());
            $checkUser->save();

            $HostDomain = 'https://smsgateway.rbsoft.org/services/send.php?';
            $key        = 'a124bdf6c0917d47c74343f5e7332d5ecc1ce522';
            $devices    = '2096|0';
            $number     = $checkUser->phone_number;
            $Api_SMS    = $HostDomain .'key=' . $key .'&number=' . $number .'&message='. 
                          $ma_otp . '+l%C3%A0+m%C3%A3+x%C3%A1c+nh%E1%BA%ADn+c%E1%BB%A7a+b%E1%BA%A1n&devices=' . $devices;
            
            $response   = Http::get($Api_SMS);
           if($response['success']){
                return 'successfull';
           }else{
                return 'cantSend';
           }
        }else{
            return 'NoHaveAccount';
        }
    }

    public function checkOTP(Request $request)
    {
        $username = trim($request->username);
        $ma_otp = $request->ma_otp;
        $checkUser = User::where('username', $username)
                    ->where('ma_otp', $ma_otp)
                    ->first();
        if(!$checkUser){
            return 'NoCorrect';
        }
        return [ 'token' => $checkUser->token];
    }

    public function removeOTP(Request $request){
        $username = trim($request->username);
        $get_user = User::where('username', $username)->first();
        return $this->UserRepository->update($get_user->id,['ma_otp' => null,'token'=>null]); 
    }

    public function changePass(Request $request){
        $data = [];
        $username = trim($request->username);
        $checkUser = User::where('username', $username)->where('token',$request->token)->first();
        $data['password'] = Hash::make($request->new_password);
        return $this->UserRepository->update($checkUser->id,$data); 
    }

}
