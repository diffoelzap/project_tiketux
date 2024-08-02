<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
   

    public function test_register()
    {
        $data = 
        [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin2@gmail.com',
                'password' => 'password', // Jangan gunakan plain password untuk testing!
                'confirm_password' => 'password',
                'terms' => '1',
                'grecaptcha' => 'valid_captcha_response'
        ];

        $response = $this->postJson('/api/auth/registration', $data);

        $response->assertStatus(201)
                 ->assertJson([
                    'status' => 'success',
                    'message' => 'Registration successfully. Please check your email address for email verification link.'
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);

        // $user = User::where('email', $data['email'])->first();
        // $this->assertNotNull($user);
        // $this->createdUserIds[] = $user->id;
    }

    public function test_login_sebelum_verifikasi()
    {
        $data = [
            'email' => 'admin2@gmail.com',
            'password' => 'password',
            'grecaptcha' => '1',
        ];

        $response = $this->postJson('/api/auth/login', $data);

        $response->assertStatus(400)
                 ->assertJson([
                    'status' => 'error',
                    'message' => 'Email is not verified'
                 ]);
        
    }

    public function test_verifikasi_email() 
    {
        $user = User::where('email','admin2@gmail.com')->first();

        $response = $this->getJson("/api/auth/verify-email/$user->email_verification_code");
        
        $response->assertStatus(200)
                 ->assertJson([
                    'status' => 'success',
                    'message' => 'Email successfully verified'
                 ]);
        
    }

    public function test_login_sesudah_verifikasi()
    {
        $data = [
            'email' => 'admin2@gmail.com',
            'password' => 'password',
            'grecaptcha' => '1',
        ];

        $response = $this->postJson('/api/auth/login',$data);

        $response->assertStatus(200);
        
    }

    public function test_update_profile()
    {
        $data = [
            'first_name' => 'Admin',
            'last_name' => 'Kedua'
        ];

        Passport::actingAs(
            User::where('email','admin2@gmail.com')->first()
        );

        $response = $this->putJson('/api/profile/edit-profile', $data);

        $response->assertStatus(200)
                 ->assertJson([
                'status' => 'success',
                'message' => 'Profile succesfully updated'
        ]);
                
    }

    public function test_update_password()
    {
        $data = [
            'old_password' => 'password',
            'new_password' => 'password',
            'confirm_password' => 'password',
        ];

        Passport::actingAs(
            User::where('email','admin2@gmail.com')->first()
        );

        $response = $this->postJson('/api/profile/update-password', $data);

        $response->assertStatus(200)
                 ->assertJson([
                    'status' => 'success',
                    'message' => 'Password successfully updated.'
        ]);
    }

    public function test_logout()
    {
        $user = User::where('email','admin2@gmail.com')->first();

        // Melakukan login dengan user yang baru dibuat
        $token = $user->createToken('testLogout')->accessToken;

        // Membuat request HTTP untuk logout dengan token yang valid
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->postJson('/api/auth/logout');

        // Memastikan respons HTTP adalah 200 (berhasil)
        $response->assertStatus(200);

        // Memastikan bahwa token telah direvoke
        $this->assertNull($user->tokens()->find($token));

        // Memastikan respons JSON berisi pesan logout berhasil
        $response->assertJson([
            'status' => 'success',
            'message' => 'Logout succesfully',
        ]);
    }

    //  

    // protected function tearDown(): void
    // {
    //     // Hapus data pengguna yang dibuat selama pengujian
    //     User::destroy($this->createdUserIds);

    //     parent::tearDown();
    // }
}
