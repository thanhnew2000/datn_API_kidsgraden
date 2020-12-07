<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\HocSinh;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // return 1;
        $device =  $request->device;
        $credentials = request(['username', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Không đúng tài khoản mk'], 401);
        }
        if(Auth::user()->role == 3){
            $DuLieuHocSinh = HocSinh::where('user_id',Auth::user()->id)->first();
            $DuLieuHocSinh->getLop;
            User::where('id',Auth::user()->id)->update(['device' => $device]);


            $all_hs = HocSinh::where('user_id',Auth::user()->id)->get();
            $all_hs->each(function ($item){
                $item->getLop;
            });

            return [
            'token_user' => $this->respondWithToken($token),
            'data_hocsinh' => $DuLieuHocSinh,
            'data_user'=> Auth::user(),
            'data_all_hs'=> $all_hs,
            ];
         return $this->respondWithToken($token);
        }else{
            return response()->json(['error' => 'Không đủ role'], 401);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}