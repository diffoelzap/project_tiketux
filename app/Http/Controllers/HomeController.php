<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Telegram\Bot\Api;
use GuzzleHttp\Client;
use App\Models\CheckEmail;
use App\Models\Transaction;
use App\Exports\EmailExport;
use Illuminate\Http\Request;
use App\Models\GroupTelegram;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function home() {
        return view('home');
    }

    public function telegram() {
        

        return view('auth.telegram');
    }

    public function dokumentasi_telegram() {

        return view('auth.telegram_dokumentasi');
    }

    public function postToken(Request $req) 
    {
        $client = new Client();

        $token_name = $req->name;
        
        if($token_name !=null) {

            try {
                $response = $client->get('https://api.telegram.org/bot'.$token_name.'/getUpdates');

                if($response->getStatusCode() == 200) {

                    $createToken = Token::create([
                        'name' => $token_name
                    ]);
        
                    if($createToken) {
                        return redirect()->back()->with('success','Token berhasil ditambahkan');
                    }else{
                        return redirect()->back()->with('error','Token gagal ditambahkan');
                    }

                }else{
                    return redirect()->back()->with('error','respon token gagal');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('error','Token tidak terdaftar');
            }

        }else{
            return redirect()->back()->with('error','Token belum di input');
        }
    }

    public function getData($type)
    {
        
        try {
            $client = new Client();

            $response = $client->get('https://api.telegram.org/bot'.$type.'/getUpdates');
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token API tidak valid'
            ]);
        }

        $body = $response->getBody()->getContents();

        $data = json_decode($body, true);

        if(count($data['result']) == 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Grup Telegram Belum ditambahkan'
            ]);
        }
        $groupIds = [];

            foreach ($data['result'] as $item) {
                if (isset($item['message']['chat']) && $item['message']['chat']['type'] === 'group') {
                    $groupIds[] = [
                        'id' => $item['message']['chat']['id'],
                        'title' => $item['message']['chat']['title'],
                    ];
                }
    
                if (isset($item['my_chat_member']['chat']) && $item['my_chat_member']['chat']['type'] === 'group') {
                    // $groupIds[] = $item['my_chat_member']['chat']['id'];
                    $groupIds[] = [
                        'id' => $item['my_chat_member']['chat']['id'],
                        'title' => $item['my_chat_member']['chat']['title'],
                    ];
                }
            }
        
        $uniqueData = [];
        foreach ($groupIds as $item) {
            $uniqueData[$item['id']] = $item;
        }
    
        // Mengurutkan kembali array sesuai dengan urutan id awal
        $result = [];
        foreach ($groupIds as $item) {
            if (isset($uniqueData[$item['id']])) {
                $result[] = $uniqueData[$item['id']];
                unset($uniqueData[$item['id']]); // menghapus elemen yang sudah diproses
            }
        }

        $lastIndex = array_key_last($result);

        return response()->json($result);
    }

    public function getDataDoc() {

        $token_bot = env('TELEGRAM_BOT_TOKEN');

        $client = new Client();
        $response = $client->get('https://api.telegram.org/bot' . $token_bot . '/getUpdates');

        $body = $response->getBody()->getContents();

        $data = json_decode($body, true);
    
        $groupIds = [];

            foreach ($data['result'] as $item) {
                if (isset($item['message']['chat']) && $item['message']['chat']['type'] === 'group') {
                    $groupIds[] = [
                        'id' => $item['message']['chat']['id'],
                        'title' => $item['message']['chat']['title'],
                    ];
                }
    
                if (isset($item['my_chat_member']['chat']) && $item['my_chat_member']['chat']['type'] === 'group') {
                    // $groupIds[] = $item['my_chat_member']['chat']['id'];
                    $groupIds[] = [
                        'id' => $item['my_chat_member']['chat']['id'],
                        'title' => $item['my_chat_member']['chat']['title'],
                    ];
                }
            }
        
        $uniqueData = [];
        foreach ($groupIds as $item) {
            $uniqueData[$item['id']] = $item;
        }
    
        // Mengurutkan kembali array sesuai dengan urutan id awal
        $result = [];
        foreach ($groupIds as $item) {
            if (isset($uniqueData[$item['id']])) {
                $result[] = $uniqueData[$item['id']];
                unset($uniqueData[$item['id']]); // menghapus elemen yang sudah diproses
            }
        }

        $lastIndex = array_key_last($result);

        return response()->json([
            'token_bot' => $token_bot,
            'chat_id' => $result,
            'lasttIndex' => $lastIndex
        ]);

    }

    public function getValidasi() {
        
        // return $transaksi;
        return view('auth.validasi');
    }

    public function getDataValidasi() {
        $transaksi = Transaction::orderBy('created_at', 'desc')->paginate(5);
        return $transaksi;
    }

    public function exportData($id_transaction = null) {
       // Membuat instance export dengan id transaksi
       $export = new EmailExport($id_transaction);

       // Menyimpan file di storage sementara
       $fileName = 'emails_' . $id_transaction . '_' . now()->format('Y_m_d_H_i_s') . '.xlsx';
       $filePath = 'exports/' . $fileName;
       
       // Simpan file
       Excel::store($export, $filePath, 'public');

       // Buat response unduhan
       return response()->download(Storage::disk('public')->path($filePath))->deleteFileAfterSend(true);

    }

    public function deleteEmail($id)
    {
        Transaction::where('id',$id)->delete();

        CheckEmail::where('id_transaction',$id)->delete();

        return redirect()->back()->with('error','Berhasil menghapus data');


    }
    

}
