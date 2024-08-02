<?php

namespace App\Jobs;

use Throwable;
use GuzzleHttp\Client;
use App\Models\CheckEmail;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CheckEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $apiKey;
    protected $idtransaction;

    // public $queue = 'CheckEmail';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $apiKey,$idtransaction)
    {
        $this->id = $id;
        $this->apiKey = $apiKey;
        $this->idtransaction = $idtransaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Processing job for CheckEmail ID: {$this->id}");

        $client = new Client();
        $emailResult = [];

        try {
            $checkEmail = CheckEmail::find($this->id);

            if (!$checkEmail) {
                throw new \Exception("CheckEmail record not found.");
            }

            $email = $checkEmail->email;
            Log::info("Email to verify: {$email}");

            $url = 'https://api.hunter.io/v2/email-verifier?email=' . $email . '&api_key=' . $this->apiKey;
            $response = $client->request('GET', $url);

            // Periksa response code
            $statusCode = $response->getStatusCode();
            
            // Response sukses
            $body = $response->getBody();
            $result = json_decode($body->getContents());

            $status = $result->data->status;

            if ($status == 'accept_all') {
                $status = 'invalid (' . $result->data->result . ')';
            }

            $emailResult[] = [
                'id' => $this->id,
                'status' => $status
            ];

            $checkEmail->update(['validation' => $status]);
            Log::info("Updated CheckEmail ID: {$this->id} with status: {$status}");

        } catch (ClientException $e) {
            // Tangani exception ClientException (biasanya untuk status code 4xx)
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $errorDetails = json_decode($body->getContents(), true);
    
            // Ambil pesan kesalahan spesifik
            $details = isset($errorDetails['errors'][0]['details']) ? $errorDetails['errors'][0]['details'] : 'Unknown error';
            $id = isset($errorDetails['errors'][0]['id']) ? $errorDetails['errors'][0]['id'] : 'Unknown error';

            $status = 'invalid (' . $details . ')';
            
            $emailResult[] = [
                'email' => $this->id,
                'status' => $status
            ];

            $checkEmail->update(['validation' => $status]);
            Log::info("ClientException for CheckEmail ID: {$this->id} with status: {$status}");

        } catch (Throwable $th) {
            // Tangani exception umum
            $status = $th->getMessage();

            $emailResult[] = [
                'email' => $this->id,
                'status' => $status
            ];

            $checkEmail->update(['validation' => $status]);
            Log::info("Throwable for CheckEmail ID: {$this->id} with status: {$status}");
        }
        
    }
}
