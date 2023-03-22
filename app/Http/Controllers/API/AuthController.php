<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use DateTime;

class AuthController extends Controller
{
    /**
     * Registration
     */
    public function register(RegisterRequest $request)
    {
        try {
            $otp = random_int(1000, 9999);
            $date = new DateTime();
            $date->modify('+1 day');
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'nickname' => $request->nickname,
                'otp_code' => $otp,
                'otp_expired' => $date,
                'phone' => $request->phone,
                'address' => $request->address,
                'is_employee' => 0,
                'is_active' => 1,
            ]);
            return response()->json(['message' => 'Register Success, Cek OTP'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'name' => $request->name,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('cakrawala')->accessToken;
            return response()->json([
                'token' => $token,
                'info' => array_merge(logged_in_user()->toArray(),[
                    'total_saving' => logged_in_user()->total_saving
                ])
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    } 
    
    public function validOTP(Request $request)
    {
        $data = [
            'name' => $request->name,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $dateNow = date("Y-m-d");
            $date    = date('Y-m-d', strtotime(logged_in_user()->otp_expired));            
            if (logged_in_user()->otp_code == $request->otp && $dateNow <= $date) {
                
                User::find(logged_in_user()->id)->update([
                    'is_active' => 1,
                ]);

                $token = auth()->user()->createToken('cakrawala')->accessToken;
                return response()->json([
                    'token' => $token,
                    'info' => array_merge(logged_in_user()->toArray(),[
                        'total_saving' => logged_in_user()->total_saving
                    ])
                ], 200);
            }elseif (logged_in_user()->is_employee != 0) {
                return response()->json(['message' => 'Kamu bukan Pengguna, Silahkan Login Menggunakan Akun pengguna'], 401);
            }elseif($dateNow > $date && logged_in_user()->otp_code == $request->otp ){
                $otp = random_int(1000, 9999);
                $date = new DateTime();
                $date->modify('+1 day');
        
                User::find(logged_in_user()->id)->update([
                    'otp_code' => $otp,
                    'otp_expired' => $date,
                ]);
                return response()->json(['message' => 'otp expired, New OTP Has been send on your email'], 401);
            }else{
                return response()->json(['message' => 'otp not Match'], 401);
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    } 
}