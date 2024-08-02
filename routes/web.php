<?php

use App\Models\User;
use App\Jobs\SomeJob;
use App\Models\Token;
use Telegram\Bot\Api;
use GuzzleHttp\Client;
use App\Jobs\DoubelJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\ProfileController;
use Laravel\Horizon\Contracts\WorkloadRepository;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Middleware Session
Route::get('/redis',function () {
    Redis::set('name','Andre');
    $name = Redis::get('name');

    // dd($name);

    return view('/welcome');
});

Route::get('/workload', function (WorkloadRepository $workload) {

    $repository = collect($workload->get())->sortBy('name')->values()->toArray();
    foreach ($repository as $item) {
            // return $dd;
        $wait = $item['wait'] / 3600;
        if ($item['length'] >= 10000) {
            Telegram::bot('mybot')->sendMessage([
                'chat_id' => 1360303210,
                'text' => 'Antrian '.$item['name'].' Mendapatkan Job sudah lebih dari 10000. Job sebanyak '.$item['length']
            ]);
        }

        if($wait >= 1) {
            Telegram::bot('mybot')->sendMessage([
                'chat_id' => 1360303210,
                'text' => 'Antrian '.$item['name'].' Mendapatkan Pengerjaan job lebih dari 1 jam. Pengerjaan selama '.round($wait).' jam'
            ]);
        }
        
        
    }
});

Route::get('/jobs/{jobs}/{user}', function ($jobs , $user) {
    $user = User::find($user);

    for ($i=0; $i < $jobs ; $i++) { 
        SomeJob::dispatch($user);
    }

});


Route::get('/doublejobs/{jobs}/{user}', function ($jobs , $user) {
    $user = User::find($user);

    for ($i=0; $i < $jobs ; $i++) { 
        DoubelJob::dispatch($user)->onQueue('queue');
    }

});


Route::get('/batch', function (){
    $batch = Bus::batch([
        new SomeJob(User::find(1)),
        new SomeJob(User::find(2)),
        new SomeJob(User::find(3)),
        new SomeJob(User::find(4)),
        new SomeJob(User::find(5)),
    ])->then(function (Batch $batch) {
        // All jobs completed successfully...
    })->catch(function (Batch $batch, Throwable $e) {
        // First batch job failure detected...
    })->finally(function (Batch $batch) {
        Log::info('Batch of SomeJobs are complete');
    })->name('Batch of SomeJobs')->dispatch();
     
    return $batch->id;
});

// Route::get('/bot/webhook', function () {
//     $updates = Telegram::getUpdates();
//     foreach ($updates as $update) {
//         // Cek apakah update memiliki pesan dari grup
//         if ($update->getMessage()->getChat()->getType() === 'group') {
//             $groupId = $update->getMessage()->getChat()->getId();
//             // Kirimkan Group ID sebagai pesan balasan
//             // Telegram::sendMessage([
//             //     'chat_id' => $groupId,
//             //     'text' => "Group ID: $groupId"
//             // ]);

//             return $groupId;die;
//         }
//     }
// });

Route::get('/exportData/{id_transaction}',[HomeController::class,'exportData'])->name('exportData');
Route::get('/deleteEmail/{id}', [HomeController::class, 'deleteEmail'])->name('deleteEmail');

Route::group(['middleware' => ['revalidate_back_history']],function(){
    //Home
    Route::get('/',[HomeController::class,'home'])->name('home');

    // Route::get('/dummy', [HomeController::class, 'dummy']);

    Route::group(['prefix' => 'telegram'], function() {
        Route::get('/',[HomeController::class,'telegram'])->name('telegram');

        Route::get('dokumentasi',[HomeController::class,'dokumentasi_telegram'])->name('dokumentasi');

        Route::post('dokumentasi',[HomeController::class,'postToken'])->name('sendToken');

        Route::get('/getData/{type}', [HomeController::class, 'getData']);

        Route::get('/getDataDoc', [HomeController::class, 'getDataDoc']);

        Route::post('/updateCheckboxStatus', [HomeController::class, 'updateCheckboxStatus']);

        Route::get('/getValidasi',[HomeController::class,'getValidasi'])->name('getValidasi');

        Route::post('postCheckEmail',[ApiController::class,'checkEmail'])->name('postCheckEmail');

        Route::get('getDataValidasi',[HomeController::class,'getDataValidasi']);


    });

    //Middleware Auth
    Route::group(['prefix' => 'auth','middleware' => ['custom_guest']],function(){
        //Registration
        Route::get('registration',[AuthController::class,'getRegister'])->name('getRegister');
        Route::post('registration',[AuthController::class,'postRegister'])->name('postRegister');


        //Verification Email
        Route::post('check_email_unique',[AuthController::class,'check_email_unique'])->name('check_email_unique');
        Route::get('verify-email/{verification_code}',[AuthController::class,'verify_email'])->name('verify_email');

        //Login
        Route::get('login',[AuthController::class,'getLogin'])->name('getLogin');
        Route::post('login',[AuthController::class,'postLogin'])->name('postLogin');

    });

    //Logout
    Route::get('auth/logout',[AuthController::class,'logout'])->name('logout')->middleware('custom_auth');

    //Middleware Profile
    Route::group(['prefix' => 'profile','middleware' => ['custom_auth']],function(){

        //Profile
        Route::get('dashboard',[ProfileController::class,'dashboard'])->name('dashboard');

        //Edit Profile
        Route::get('edit-profile',[ProfileController::class,'edit_profile'])->name('edit_profile');
        Route::put('edit-profile',[ProfileController::class,'update_profile'])->name('update_profile');

        //Change Password
        Route::get('change-password',[ProfileController::class,'change_password'])->name('change_password');
        Route::post('update-password',[ProfileController::class,'update_password'])->name('update_password');
    });
});

