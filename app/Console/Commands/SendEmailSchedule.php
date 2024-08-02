<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail verification to all users by running this command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Ambil semua user
        $users = User::where('email_verified_at',null)->get();
       
        foreach ($users as $value) {
            Mail::to($value->email)->send(new EmailVerificationMail($value));
        }

        Log::info('Schedule is Running');
    }
}
