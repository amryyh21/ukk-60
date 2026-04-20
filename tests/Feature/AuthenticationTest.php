<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_and_is_redirected_to_admin_dashboard(): void
    {
        $this->seed();

        $response = $this->post(route('login.post'), [
            'login_field' => '00000000',
            'password' => 'admin21',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticated();
    }

    public function test_siswa_can_login_and_is_redirected_to_student_dashboard(): void
    {
        $this->seed();

        $response = $this->post(route('login.post'), [
            'login_field' => '20240015',
            'password' => 'siswa21',
        ]);

        $response->assertRedirect('/siswa');
        $this->assertAuthenticated();
    }

    public function test_invalid_login_returns_validation_error(): void
    {
        $this->seed();

        $response = $this->from(route('login'))->post(route('login.post'), [
            'login_field' => '20240015',
            'password' => 'password-salah',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('login_field');
        $this->assertGuest();
    }
}
