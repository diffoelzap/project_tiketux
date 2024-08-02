<?php

namespace App\Console\Commands;

use Log;
use App\Models\User;
use App\Models\CheckEmail;
use App\Models\Transaction;
use Illuminate\Console\Command;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;

class CheckEmailSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:check-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Email verification to all users by running this command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       // Ambil semua transaksi yang statusnya 0
       $transactions = Transaction::where('status', 0)->get();

       foreach ($transactions as $transaction) {
           // Ambil semua email yang berhubungan dengan transaksi ini
           $emails = CheckEmail::where('id_transaction', $transaction->id)->get();

           // Debugging: Log jumlah email
           \Log::info('Checking transaction ID: ' . $transaction->id . ' with ' . $emails->count() . ' emails.');

           if ($emails->isEmpty()) {
               // Jika tidak ada email, set status transaksi ke 0 dengan validasi 'No'
               $transaction->status = 0;
               $transaction->save();
               
               // Debugging: Log pembaruan status
               \Log::info('Transaction ID ' . $transaction->id . ' status set to 0 because there are no emails.');
           } else {
               // Periksa apakah semua email sudah divalidasi (tidak ada yang null)
               $allValidated = $emails->every(function ($email) {
                   return $email->validation !== null;
               });

               // Debugging: Log hasil validasi
               \Log::info('All emails validated: ' . ($allValidated ? 'Yes' : 'No'));

               if ($allValidated) {
                   // Jika semua email sudah divalidasi, perbarui status transaksi
                   $transaction->status = 1;
                   $transaction->save();
                   
                   // Debugging: Log pembaruan status
                   \Log::info('Transaction ID ' . $transaction->id . ' status updated to 1.');
               }
           }
       }

       $this->info('Transaction status check completed.');
   
       
    }
}
