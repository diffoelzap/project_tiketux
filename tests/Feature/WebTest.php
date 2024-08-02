<?php

namespace Tests\Feature;
use Faker\Factory as FakerFactory;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_buka_halaman_registrasi()
    {
        $response = $this->get('/auth/registration');

        $response->assertStatus(200);
    }

    public function test_melakukan_registrasi()
    {
        
    //    $faker = FakerFactory::create();

    //    $email=$faker->unique()->safeEmail;

       $response = $this->post(route('postRegister'), [
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin1@gmail.com',
            'password' => 'password', // Jangan gunakan plain password untuk testing!
            'confirm_password' => 'password',
            'terms' => '1',
            'grecaptcha' => 'valid_captcha_response'
        ]);

    //    dd(session()->all());
       $response->assertRedirect()
                ->assertSessionHas('success', 'Registration successfully. Please check your email address for email verification link.');
       

       $this->assertDatabaseHas('users', [
            'email' => 'admin1@gmail.com'
       ]);

       $response->assertStatus(302);
    }

    public function test_buka_halaman_login()
    {

        $response = $this->get('/auth/login');

        $response->assertStatus(200);
    }

    public function test_melakukan_login_sebelum_verifikasi()
    {
        $response = $this->post(route('postLogin'), [
            'email' => 'admin1@gmail.com',
            'password' => 'password',
            'grecaptcha' => '1',
        ]);

        $response->assertRedirect()
        ->assertSessionHas('error', 'Email is not verified');
        
        $response->assertStatus(302);
    }

    public function test_melakukan_verifikasi_email() {
        $user = User::where('email','admin1@gmail.com')->first();

        $response = $this->get("auth/verify-email/$user->email_verification_code");
        
        $response->assertRedirect()
        ->assertSessionHas('success', 'Email successfully verified');
        
        $response->assertStatus(302);
    }

    public function test_melakukan_login_sesudah_verifikasi(){

        $response = $this->post(route('postLogin'), [
            'email' => 'admin1@gmail.com',
            'password' => 'password',
            'grecaptcha' => '1',
        ]);

        $response->assertRedirect('profile/dashboard')
        ->assertSessionHas('success', 'Login succesfully');
        
        $response->assertStatus(302);
    }

    public function test_membuka_halaman_dashboard() {

        $user = User::where('email','admin1@gmail.com')->first();

        $this->actingAs($user);

        $response = $this->get('/profile/dashboard');

        $response->assertStatus(200);
    }

    public function test_membuka_halaman_edit_profile() {

        $user = User::where('email','admin1@gmail.com')->first();

        $this->actingAs($user);

        $response = $this->get('profile/edit-profile');

        $response->assertSee($user->first_name);
        $response->assertSee($user->last_name);
        $response->assertStatus(200);

    }

    public function test_update_profile() {
        
        $user = User::where('email','admin1@gmail.com')->first();

        $this->actingAs($user);

        $response = $this->put(route('update_profile'), [
            'first_name' => 'Admin',
            'last_name' => 'Pertama',
        ]);

        $response->assertRedirect()
                ->assertSessionHas('success', 'Profile succesfully updated');
                
        $response->assertStatus(302);
    }

    public function test_membuka_halaman_edit_password() {
        $user = User::where('email','admin1@gmail.com')->first();

        $this->actingAs($user);

        $response = $this->get('profile/change-password');

        $response->assertStatus(200);

    }

    public function test_update_change_password() {
        $user = User::where('email','admin1@gmail.com')->first();

        $this->actingAs($user);

        $response = $this->post(route('update_password'), [
            'old_password' => 'password',
            'new_password' => 'password',
            'confirm_password' => 'password',
        ]);

        $response->assertRedirect()
                ->assertSessionHas('success', 'Password successfully updated.');

        $response->assertStatus(302);
    }

    public function test_logout() {
        $user = User::where('email','admin1@gmail.com')->first();

        $this->actingAs($user);

        $response = $this->get('auth/logout');

        $response->assertRedirect()
                ->assertSessionHas('success', 'Logout succesfully');

        $response->assertStatus(302);
    }


}
