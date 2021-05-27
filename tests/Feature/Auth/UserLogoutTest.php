<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserLogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_logged_in_user_can_logout()
    {
        $user = factory(User::class)->create();

        auth()->login($user);

        // assert that the user is logged in
        $this->assertEquals($user->email, optional(Auth::user())->email);

        $this->post('auth/logout')
            ->assertRedirect('/');

        $this->assertNull(Auth::user());
    }
}
