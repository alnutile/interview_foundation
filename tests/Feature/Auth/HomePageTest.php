<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_unauthenticated_user_cannot_access_the_home_page()
    {
        $this->get('/home')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_access_the_home_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/home')
            ->assertViewIs('home');
    }
}
