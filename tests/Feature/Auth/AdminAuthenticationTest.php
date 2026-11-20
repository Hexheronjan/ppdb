<?php

namespace Tests\Feature\Auth;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminResetPasswordNotification;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_authenticate_with_valid_credentials(): void
    {
        $admin = Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('secure-password'),
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'secure-password',
            'remember' => '1',
        ]);

        $this->assertAuthenticatedAs($admin, 'admin');
        $response->assertRedirect('/admin/dashboard');
    }

    public function test_admin_can_change_password_from_profile(): void
    {
        $admin = Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('old-password'),
        ]);

        $this->actingAs($admin, 'admin')->put('/admin/profile/update', [
            'name' => $admin->name,
            'email' => $admin->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])->assertRedirect('/admin/profile/edit');

        $this->post('/logout');
        $this->post('/login', [
            'email' => $admin->email,
            'password' => 'new-password',
        ])->assertRedirect('/admin/dashboard');

        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_admin_can_request_a_password_reset_link(): void
    {
        Notification::fake();
        $admin = Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('secure-password'),
        ]);

        $this->post('/admin/forgot-password', ['email' => $admin->email])
            ->assertSessionHasNoErrors();

        Notification::assertSentTo($admin, AdminResetPasswordNotification::class);
    }
}
