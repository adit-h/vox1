<?php

namespace Tests\Unit;

use App\Services\LoginService;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    public function test_open_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_service_can_login()
    {
        $body = [
            "email" => config('api.user_email'),
            "password" => config('api.user_pass'),
        ];
        $login_service = LoginService::post($body);

        $this->assertIsObject($login_service);
    }

    public function test_service_failed_login()
    {
        $body = [
            "email" => "user@mail.com",
            "password" => "test123",
        ];
        $login_service = LoginService::post($body);

        $this->assertIsObject($login_service);
    }
}
