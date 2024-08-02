<?php

namespace App\Http\Controllers\API;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Client;
use App\Jobs\SendEmailJob;
use App\Models\CheckEmail;
use App\Jobs\CheckEmailJob;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Laravel\Passport\Token;
use App\Exports\EmailExport;
use App\Imports\EmailImport;
use Illuminate\Http\Request;
use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use DeveloperNode\Email\EmailVerifier;
use Illuminate\Support\Facades\Storage;
use sorciulus\EmailChecker\EmailChecker;
use Epifrin\DisposableEmailChecker\DisposableEmailChecker;
use sorciulus\EmailChecker\Exception\EmailCheckerException;


class ApiController extends Controller
{
    public function postRegister(Request $req) 
    {   
        
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

            return response()->json([
                'status' => 'success',
                'message' => 'Registration successfully. Please check your email address for email verification link.'
            ],201);
    
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Captcha'
            ],400);
        }
    }

    public function verify_email($verification_code) {

        $user = User::where('email_verification_code',$verification_code)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid URL'
            ],400);

        } else {
            if ($user->email_verified_at) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Email already verified'
                ],400);

            }else{
                $user->update([
                    'email_verified_at' => Carbon::now()
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Email successfully verified'
                ],200);
            }
        }
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
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Email is not registered'
                    ],400);
                }else{
                    if(!$user->email_verified_at){
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Email is not verified'
                        ],400);

                    }else{
                        if(!$user->is_active){
                            return response()->json([
                                'status' => 'error',
                                'message' => 'User is not active'
                            ],400);

                        }else{

                            $remember_me = ($req->remember_me)?true:false;
                            if (auth()->attempt($req->only('email','password'),$remember_me)) {
                                $token = $user->createToken("myToken")->accessToken;

                                return response()->json([
                                    'status' => 'success',
                                    'message' => 'Login succesfully',
                                    'token' => $token
                                ],200);
                            }else{
                                return response()->json([
                                    'status' => 'error',
                                    'message' => 'Invalid credentials'
                                ],400);

                            }
                        }
                    }
                }
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Captcha'
                ],400);
            }

        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->token()->revoke();

            return response()->json([
                'status' => 'success',
                'message' => 'Logout succesfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated',
            ], 401);
        }
    }

    public function update_profile(Request $req) {

        $req->validate([
            'first_name' => 'required|min:2|max:100',
            'last_name' => 'required|min:2|max:100',
        ],[
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
        ]);

        $user = auth()->user();

        $user->update([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Profile succesfully updated'
        ],200);

    }

    public function update_password(Request $request){
        $request->validate([
        'old_password'=>'required|min:6|max:100',
        'new_password'=>'required|min:6|max:100',
        'confirm_password'=>'required|same:new_password'
        ]);

        $current_user=auth()->user();

        if(Hash::check($request->old_password,$current_user->password)){

            $current_user->update([
                'password'=>bcrypt($request->new_password)
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password successfully updated.'
            ],200);

        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Old password does not matched.'
            ],400);

        }

    }

    public function checkEmail(Request $request) {

        try {
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls,csv'
            ]);

            $file = $request->file('file');

            $import = new EmailImport();
                Excel::import($import, $file);

                // Ambil emails dari class import yang telah dibuat
            $emails = $import->getEmails();

            $fileName = $file->getClientOriginalName();

            $transaction = Transaction::create([
                'count' => count($emails),
                'status' => 0,
                'name' => $fileName
            ]);

            $idTransaction = $transaction->id;

            $key = '85b60541e9ced8c5e4ab405e577ff04c106978d2';
            $path = '/v2/';
            // $emails = ['diffoelza@yahoo','diffoelzap54@gmail.com'];
            $client = new Client();
            // $email = 'diffoelzap@gmail.com';
            $emailResult = [];
            
            foreach ($emails as $email) {
                if (!empty($email)) {
                    $checkEmail = CheckEmail::create([
                        'email' => $email,
                        'validation' => null,
                        'id_transaction' => $idTransaction                    
                    ]);

                    Log::info("Dispatching job for CheckEmail ID: {$checkEmail->id}, Email: {$email}");

                    CheckEmailJob::dispatch($checkEmail->id, $key,$idTransaction)->onQueue('checkEmail')->delay(now()->addMinutes(1));
                }
            }

            // $fileName = 'check_email' . now()->format('Y_m_d_H_i_s') . '.xlsx';
            // Excel::store(new EmailExport, $fileName, 'public');

            // $url = Storage::url($fileName);

            return redirect()->back()->with('success', 'Berhasil Import Excel');
        }catch (\Exception $e) {
            // Tangani kesalahan dengan mengarahkan kembali ke form dengan pesan kesalahan
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

}

?>