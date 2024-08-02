<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('checkEmailValid',[ApiController::class,'checkEmail']);

//Middleware Session
Route::group(['middleware' => ['revalidate_back_history']],function(){
    //Home
    // Route::get('/',[HomeController::class,'home'])->name('home');

    //Middleware Auth
    Route::group(['prefix' => 'auth','middleware' => ['custom_guest']],function(){
        //Registration
        // Route::get('registration',[AuthController::class,'getRegister'])->name('getRegister');
        Route::post('registration',[ApiController::CLASS,'postRegister'])->name('postRegister');

        //Verification Email
        // Route::post('check_email_unique',[AuthController::class,'check_email_unique'])->name('check_email_unique');
        Route::get('verify-email/{verification_code}',[ApiController::class,'verify_email'])->name('verify_email');

        //Login
        // Route::get('login',[AuthController::class,'getLogin'])->name('getLogin');
        Route::post('login',[ApiController::class,'postLogin'])->name('login');


    });

    //Logout
    Route::post('auth/logout',[ApiController::class,'logout'])->middleware('auth:api');

    //Middleware Profile
    Route::group(['prefix' => 'profile','middleware' => ['auth:api']],function(){

        //Profile
        // Route::get('dashboard',[ProfileController::class,'dashboard'])->name('dashboard');

        //Edit Profile
        // Route::get('edit-profile',[ProfileController::class,'edit_profile'])->name('edit_profile');
        Route::put('edit-profile',[ApiController::class,'update_profile'])->name('update_profile');

        //Change Password
        // Route::get('change-password',[ProfileController::class,'change_password'])->name('change_password');
        Route::post('update-password',[ApiController::class,'update_password'])->name('update_password');
    });
});
