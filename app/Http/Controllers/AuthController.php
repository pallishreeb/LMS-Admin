<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Twilio\Rest\Client;
class AuthController extends Controller
{
// Show Register/Create Form
public function create() {
    return view('auth.register');
}

// Create New User
public function store(Request $request) {
    $formFields = $request->validate([
        'name' => ['required', 'min:3'],
        'email' => ['required', 'email', Rule::unique('users', 'email')],
        'mobile_number'=> ['required'],
        'password' => 'required|confirmed|min:6'
    ]);

    // Hash Password
    $formFields['password'] = bcrypt($formFields['password']);
    try {
    // Create User
    $user = User::create($formFields);
    }catch (QueryException $e) {
        if ($e->errorInfo[1] == 1062) { // Check if the error code corresponds to a duplicate entry
            return redirect()->route('auth.register')->with('error', 'Email already exists.');
        } else {
            // Handle other query exceptions if needed
            return redirect()->route('auth.register')->with('error', 'An error occurred while processing your request.');
        }
    }
    // Login
    auth()->login($user);

    return redirect('/admin')->with('message', 'User created and logged in');
}

// Logout User
public function logout(Request $request) {
    auth()->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('message', 'You have been logged out!');

}

// Show Login Form
public function login() {
    return view('auth.login');
}

// Authenticate User
public function authenticate(Request $request) {
    $formFields = $request->validate([
        'email' => ['required', 'email'],
        'password' => 'required',
        'device_id'=>'required'
    ]);
    // dd($request);
    $user = User::where('email', $request->email)->first();
    if($user){
         // Check if the provided device_id matches the stored device_id
         $deviceMatch = $request->device_id === $user->device_id;
        if ($deviceMatch == false) {
            // Generate OTP
            $otp = Str::random(6);
    
            // Store OTP and its expiration time in the user's record
            $user->update([
                'otp' => $otp,
                'otp_valid_until' => now()->addMinutes(2),
                'device_id' =>$request->device_id
            ]);
    
            // Send OTP via email
            Mail::to($user->email)->send(new OtpMail($otp));
            // Store email in the session
            $request->session()->put('otp_email', $user->email);
            // Use Twilio to send the OTP via SMS
            $account_sid = getenv('TWILIO_ACCOUNT_SID');
            $auth_token = getenv('TWILIO_AUTH_TOKEN');
            $twilio_number = getenv('TWILIO_PHONE_NUMBER');
    
            $client = new Client($account_sid, $auth_token);
            $client->messages->create(
                // Where to send a text message
                '+918144128737',
                array(
                    'from' => $twilio_number,
                    'body' => 'Your OTP is: ' . $otp,
                )
            );
            if(auth()->attempt($formFields)) {
                $request->session()->regenerate();
                return redirect()->route('verify.otp.form');
            }
        }
        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/admin')->with('message', 'You are now logged in!'); 
        }
    }else{
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
  
}

//verify otp form
public function showOtpVerificationForm(Request $request)
{

    $email = $request->session()->get('otp_email');

    return view('auth.verify-otp', compact('email'));
}
//verify otp
public function verifyOtp(Request $request)
{
     $request->validate([
        'email' => 'required|email',
        'otp' => 'required',
    ]);

    $user=User::where('email',$request->email)->first();

    if ($user && $user->otp === $request->otp && now()->lt($user->otp_valid_until)) {
    $user->update(['email_verified_at' => now(), 'otp' => null, 'otp_valid_until' => null]);
        return redirect('/admin')->with('message', 'You are now logged in!');    
    }else {
        return back()->with('error', 'Invalid OTP. Please try again.');
    }
}

}