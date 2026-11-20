<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_user_is_registered_and_sent_to_otp_verification(): void
    {
        Http::fake();

        $response = $this->post('/register', [
            'name' => 'Test User',
            'no_wa' => '081234567890',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'no_wa' => '081234567890',
        ]);
        $response->assertRedirect(route('otp.verify.form', absolute: false));
    }
}
