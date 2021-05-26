<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
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

        $this->assertDatabaseHas('users', Arr::only($data, ['name','email']));
    }

    /** @test */
    public function user_must_register_with_valid_email()
    {
        $this->postJson('/auth/registration', [
            'name'=>'hello world',
            'email'=>'hello/world',
            'password'=>'password'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        $this->assertDatabaseMissing('users', [
            'name'=>'hello world',
            'email'=>'hello@world',
        ]);
    }

    /** @test */
    public function user_cannot_register_with_existing_email()
    {
        factory(User::class)->create(['email'=>'hello@world.com']);
        $this->postJson('/auth/registration', [
            'name'=>'hello world',
            'email'=>'hello@world.com',
            'password'=>'password'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }
}
