<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_the_login_page()
    {
        $this->get('login')
            ->assertOk();
    }

    /** @test */
    public function a_user_can_login_successfully()
    {
        $user = factory(User::class)->create(['email' => 'hello@wold.com', 'password' => 'password']);

        $this->postJson('auth/login', ['email' => 'hello@wold.com', 'password' => 'password'])
            ->assertOk();
        // check that the user was logged in
        $this->assertTrue($user->is(Auth::user()));
    }

    /** @test */
    public function a_user_cannot_login_with_invalid_details()
    {
        factory(User::class)->create(['email' => 'hello@wold.com', 'password' => 'password']);

        $this->postJson('auth/login', ['email' => 'world@hello.com', 'password' => 'password'])
            ->assertUnauthorized()
            ->assertJsonValidationErrors(['email']);
        // check that the user was logged in
        $this->assertNull(Auth::user());
    }

    /** @test */
    public function user_must_provide_a_password_and_a_valid_email()
    {
        $this->postJson('auth/login', ['email' => 'worldhello.com'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }
}
