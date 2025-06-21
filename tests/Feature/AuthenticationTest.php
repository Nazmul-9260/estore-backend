<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticationTest extends TestCase
{
    // Never use it at production, all database records will be deleted !!
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_authenticated_user_can_login()
    {
        $credentials = [
            'email' => 'ashikmeherpial@gmail.com',
            'password' => '12345678'
        ];

        $user = new User();

        $user = $user->fill($credentials);

        // $user = $this->actingAs($user);

        $response = $this->post('/login', $credentials);

        $response->assertRedirect('/home');
    }

    public function test_authenticated_user_can_logout()
    {

        $credentials = [
            'email' => 'ashikmeherpial@gmail.com',
            'password' => '12345678'
        ];

        $user = new User();

        $user = $user->fill($credentials);

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/');

        $this->assertGuest();
    }
}
