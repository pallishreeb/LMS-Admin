<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Hash;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name'=>'required|min:2|max:100',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:100',
            'mobile_number'=> 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ],422);
        }

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'mobile_number'=> $request->mobile_number,
        ]);

       // sendOtp($request);
        return response()->json([
            'message'=>'Registration successfull',
            'data'=>$user
        ],200);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users',
            'otp' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validation fails',
                'errors'=>$validator->errors()
            ],422);
        }
        $user=User::where('email',$request->email)->first();

        if ($user && $user->otp === $request->otp && now()->lt($user->otp_valid_until)) {
            $user->update(['email_verified_at' => now(), 'otp' => null, 'otp_valid_until' => null]);
            return response()->json(['message' => 'OTP verified successfully.'],200);
        }

        return response()->json(['message' => 'Invalid OTP or expired.'], 422);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validation fails',
                'errors'=>$validator->errors()
            ],422);
        }

        $user=User::where('email',$request->email)->first();

        if($user){

            if(Hash::check($request->password,$user->password)){

                $token=$user->createToken('auth-token')->plainTextToken;

                return response()->json([
                    'message'=>'Login Successfull',
                    'token'=>$token,
                    'data'=>$user
                ],200); 

            }else{
                return response()->json([
                    'message'=>'Incorrect credentials',
                ],400); 
            }

        }else{

            return response()->json([
                'message'=>'Incorrect credentials',
            ],400); 
        }




    }

    public function user(Request $request){
        return response()->json([
            'message'=>'User successfully fetched',
            'data'=>$request->user()
        ],200); 
    }

    public function logout(Request $request){

       $request->user()->currentAccessToken()->delete(); 
        return response()->json([
            'message'=>'User successfully logged out',
        ],200); 
    }

    public function sendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Generate OTP
            $otp = Str::random(6);

            // Store OTP and its expiration time in the user's record
            $user->update([
                'otp' => $otp,
                'otp_valid_until' => now()->addMinutes(5), // Adjust the expiration time as needed
            ]);

            // Send OTP via email
            Mail::to($user->email)->send(new OtpMail($otp));

            return response()->json(['message' => 'OTP sent successfully']);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
   
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_valid_until', '>', now())
            ->first();

        if ($user) {
            // Reset password and remove OTP details
            $user->update([
                'password' => Hash::make($request->password),
                'otp' => null,
                'otp_valid_until' => null,
            ]);

            return response()->json(['message' => 'Password reset successfully']);
        }

        return response()->json(['message' => 'Invalid OTP or expired'], 422);
    }
}