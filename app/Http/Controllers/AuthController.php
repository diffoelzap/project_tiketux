<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Client;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function getRegister() {
        
    
        return view('auth.register');
    }

    public function check_email_unique(Request $req) {

        $email = $req->input('email');
        $exists = User::where('email', $email)->exists();

        if ($exists) {
            return 'false'; // Pesan kesalahan
        } else {
            return 'true';// Email unik
        }
    }

    public function postRegister(Request $req) {
        
        $req->validate([
            'first_name' => 'required|min:2|max:100',
            'last_name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:password',
            'terms' => 'required',
            'grecaptcha' => 'required'
        ],[
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
        ]);
    
        $grecaptcha = $req->grecaptcha;
    
        if (env('CAPTCHA_TESTING')) {
            $captchaSuccess = true;
        } else {
            try {
                $client = new Client();
                $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                    'form_params' => [
                        'secret' => env('GOOGLE_CAPTCHA_SECRET'),
                        'response' => $grecaptcha
                    ]
                ]);
                $body = json_decode((string)$response->getBody());
                $captchaSuccess = $body->success;
            } catch (Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
    
        if ($captchaSuccess) {
            $user = User::create([
                'first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'email' => $req->email,
                'password' => bcrypt($req->password),
                'email_verification_code' => Str::random(40)
            ]);
    
            SendEmailJob::dispatch($user);
    
            return redirect()->back()->with('success', 'Registration successfully. Please check your email address for email verification link.');
        } else {
            return redirect()->back()->with('error', 'Invalid Captcha');
        }
        
        
    }

    public function verify_email($verification_code) {

        $user = User::where('email_verification_code',$verification_code)->first();
        if (!$user) {
            return redirect()->route('getRegister')->with('error','Invalid URL');
        } else {
            if ($user->email_verified_at) {
                return redirect()->route('getRegister')->with('error','Email already verified');
            }else{
                $user->update([
                    'email_verified_at' => Carbon::now()
                ]);

                return redirect()->route('getRegister')->with('success','Email successfully verified');
            }
        }
    }

    public function getLogin() {
        return view('auth.login');
    }

    public function postLogin(Request $req){

        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:100',
            'grecaptcha' => 'required'
        ]);

        $grecaptcha = $req->grecaptcha;

        try {
            if (env('CAPTCHA_TESTING')) {
                $captchaSuccess = true;
            }else{
                try {
                    $client = new Client();
                    $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                        'form_params' => [
                            'secret' => env('GOOGLE_CAPTCHA_SECRET'),
                            'response' => $grecaptcha
                        ]
                    ]);
                    $body = json_decode((string)$response->getBody());
                    $captchaSuccess = $body->success;
                } catch (Throwable $th) {
                    return response()->json($th->getMessage());
                }
            }

            if ($captchaSuccess) {
               
                $user = User::where('email',$req->email)->first();

                if(!$user) {
                    return redirect()->back()->with('error','Email is not registered');
                }else{
                    if(!$user->email_verified_at){
                        return redirect()->back()->with('error','Email is not verified');
                    }else{
                        if(!$user->is_active){
                            return redirect()->back()->with('error','User is not active'); 
                        }else{

                            $remember_me = ($req->remember_me)?true:false;
                            if (auth()->attempt($req->only('email','password'),$remember_me)) {
                                return redirect()->route('dashboard')->with('success','Login succesfully');
                            }else{
                                return redirect()->back()->with('error','Invalid credentials'); 
                            }
                        }
                    }
                }
            }else{
                return redirect()->back()->with('error','Invalid Captcha');
            }

        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function logout() {
        auth()->logout();

        return redirect()->route('getLogin')->with('success','Logout succesfully');
    }
}
