<?php

namespace App\Console;

use App\Models\Token;
use Telegram\Bot\Api;
use GuzzleHttp\Client;
use App\Mail\NotifHorizonMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Horizon\Contracts\WorkloadRepository;
use Laravel\Horizon\Contracts\MasterSupervisorRepository;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function isHorizonActive() : bool 
    {
        if (! $masters = app(MasterSupervisorRepository::class)->all()) {
            return false;
        }

        return collect($masters)->some(function ($master) {
            return $master->status !== 'paused';
        });
    }


    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:check-email')->cron('* * * * *');

        // $schedule->call(function() {
        //     if (!$this->isHorizonActive()) {
        //         // Mail::to('admin1@example.com')->send(new NotifHorizonMail());   
        //         Telegram::bot('mybot')->sendMessage([
        //             'chat_id' => -4227469542,
        //             'text' => 'Horizon sedang mati'
        //         ]);       
        //     }
        //     // Log::info("Horizon sedang Hidup");         

        // })
        // ->everyFiveMinutes();

        $schedule->call(function(WorkloadRepository $workload) {

            $repository = collect($workload->get())->sortBy('name')->values()->toArray();

            $token = Token::all();

            $client = new Client();

            foreach($token as $value) {
                $response = $client->get('https://api.telegram.org/bot'.$value['name'].'/getUpdates');

                $body = $response->getBody()->getContents();


                $data = json_decode($body, true);
                $groupIds = [];

                    foreach ($data['result'] as $item) {
                        if (isset($item['message']['chat']) && $item['message']['chat']['type'] === 'group') {
                            $groupIds[] = $item['message']['chat']['id'];
                        }

                        if (isset($item['my_chat_member']['chat']) && $item['my_chat_member']['chat']['type'] === 'group') {
                            $groupIds[] = $item['my_chat_member']['chat']['id'];
                        }
                    }

                $groupIds = array_unique($groupIds);

                Log::info($groupIds);


                if (!$this->isHorizonActive()) {
                    // Mail::to('admin1@example.com')->send(new NotifHorizonMail());   
                    
                    $telegram = new Api((string) $value['name']);

                    foreach($groupIds as $id) {

                        $response = $telegram->getMe();
                
                        $response = $telegram->sendMessage([
                            'chat_id' => $id,
                            'text' => 'Horizon sedang mati'
                        ]);

                    }

                }else{
                    foreach ($repository as $item) {
                        // return $dd;
                        $wait = $item['wait'] / 3600;

                        foreach ($groupIds as $id) {
                            if ($item['length'] >= 10000) {
                                
                                $telegram = new Api((string) $value['name']);

                                $response = $telegram->getMe();
                
                                $response = $telegram->sendMessage([
                                    'chat_id' => $id,
                                    'text' => 'Antrian '.$item['name'].' Mendapatkan Job sudah lebih dari 10000. Job sebanyak '.$item['length']
                                ]);

                                // Telegram::bot('mybot')->sendMessage([
                                //     'chat_id' => $id,
                                //     'text' => 'Antrian '.$item['name'].' Mendapatkan Job sudah lebih dari 10000. Job sebanyak '.$item['length']
                                // ]);
                            }
                    
                            if($wait >= 1) {
                                $telegram = new Api((string) $value['name']);

                                $response = $telegram->getMe();

                                $response = $telegram->sendMessage([
                                    'chat_id' => $id,
                                    'text' => 'Antrian '.$item['name'].' Mendapatkan Pengerjaan job lebih dari 1 jam. Pengerjaan selama '.round($wait).' jam'
                                ]);

                                // Telegram::bot('mybot')->sendMessage([
                                //     'chat_id' => $id,
                                //     'text' => 'Antrian '.$item['name'].' Mendapatkan Pengerjaan job lebih dari 1 jam. Pengerjaan selama '.round($wait).' jam'
                                // ]);
                            }
                        }
                        
                
                    }
                }
            }


        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
