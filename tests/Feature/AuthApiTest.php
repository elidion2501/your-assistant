<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_sign_up_success()
    {

        $response = $this->postJson('/api/auth/signUp', [
            'nickname' => 'test_name32',
            'password' => 'test_password',
            'password_confirmation' => 'test_password',
            'email' => 'test@email.sk32',
        ]);

        $response
            ->assertJson([
                'code' => "200",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'data' => [
                        'token',
                    ]
                ]
            );
    }
    public function test_sign_up_failed_validation()
    {

        $response = $this->postJson('/api/auth/signUp', []);

        $response
            ->assertJson([
                'code' => "422",
            ])
            ->assertJsonValidationErrors(['nickname', 'password', 'email']);
    }


    public function test_sign_up_failed_user_already_exist()
    {

        $user = User::factory()->create();

        $response = $this->postJson('/api/auth/signUp', [
            'email' =>   $user->email,
            'nickname' =>   $user->nickname,
            'password' =>   $user->password,
        ]);
        $response
            ->assertJson([
                'code' => "422",
            ])
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_success()
    {
        $user = User::factory()->create()->first();

        $response = $this->postJson('/api/auth/login', [
            'password' =>  'test1',
            'email' =>  $user->email,
        ]);

        $response
            ->assertJson([
                'code' => "200",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'data' => [
                        'token',
                    ]
                ]
            );
    }
}
