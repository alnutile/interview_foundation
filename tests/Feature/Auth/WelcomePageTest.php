<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_unauthenticated_user_can_access_the_welcome_page()
    {
        $this->get('/')
            ->assertOk()
            ->assertViewIs('welcome');
    }

    /** @test */
    public function an_authenticated_user_cannot_access_the_welcome_page()
    {
        auth()->login(factory(User::class)->create());

        $this->get('/')
            ->assertRedirect('/home');
    }
}
