<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Session;

use App\User;

class RegisterTest extends TestCase
{
    use DatabaseTransactions; 
    public function testRegisterFormDisplayed()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testRegisterValidUser()
    {
        Session::start();
        $user = factory(User::class)->make();

        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            '_token' => csrf_token()
        ]);

        $response->assertStatus(302);

        $this->assertAuthenticated();
    }

    public function testDoesNotRegisterInvalidUser()
    {
        Session::start();
        $user = factory(User::class)->make();

        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'invalid',
            '_token' => csrf_token()
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }
}
