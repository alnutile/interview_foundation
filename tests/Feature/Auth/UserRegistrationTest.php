<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register_in_app()
    {
        $data = factory(User::class)->raw();

        $this->postJson('/auth/registration', $data)
            ->assertCreated();

        $this->assertDatabaseHas('users', Arr::only($data, ['name', 'email']));
    }

    /** @test */
    public function user_password_is_hashed()
    {
        $data = factory(User::class)->raw(['email' => 'hello@you.com', 'password' => 'helloThere']);

        $this->postJson('/auth/registration', $data)
            ->assertCreated();

        $user = User::where('email', 'hello@you.com')->first();

        $this->assertTrue(Hash::check('helloThere', $user->password));
    }

    /** @test */
    public function registered_user_is_automatically_logged_in()
    {
        $data = factory(User::class)->raw();

        $this->postJson('/auth/registration', $data)
            ->assertCreated();

        $this->assertEquals(optional(Auth::user())->email, $data['email']);
    }

    /** @test */
    public function user_must_register_with_valid_email()
    {
        $this->postJson('/auth/registration', [
            'name' => 'hello world',
            'email' => 'hello/world',
            'password' => 'password',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        $this->assertDatabaseMissing('users', [
            'name' => 'hello world',
            'email' => 'hello@world',
        ]);
    }

    /** @test */
    public function user_cannot_register_with_existing_email()
    {
        factory(User::class)->create(['email' => 'hello@world.com']);
        $this->postJson('/auth/registration', [
            'name' => 'hello world',
            'email' => 'hello@world.com',
            'password' => 'password',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }
}
