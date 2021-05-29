<?php

namespace Tests\Feature\Github;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateTokenTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_logged_in_user_can_add_a_github_token()
    {
        $user = factory(User::class)->create();

        $this->assertNull($user->github_token);

        $this->actingAs($user)
            ->putJson('/auth/githubToken', ['token' => Str::random(10)])
            ->assertCreated();

        $this->assertNotNull($user->fresh()->github_token);
    }

    /** @test */
    public function a_logged_in_user_cannot_add_a_blank_github_token()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->putJson('/auth/githubToken', ['token' => ''])
            ->assertStatus(422)
            ->assertJsonValidationErrors('token');
    }

    /** @test */
    public function encrypted_token_is_what_is_stored_in_the_database()
    {
        $user = factory(User::class)->create();

        $this->assertNull($user->github_token);

        $token = Str::random(10);

        $this->actingAs($user)
            ->putJson('/auth/githubToken', ['token' => $token])
            ->assertCreated();

        $this->assertNotEquals($user->fresh()->github_token, $token);
    }

    /** @test */
    public function user_github_token_attribute_returns_decrypted_token_value()
    {
        $user = factory(User::class)->create();

        $token = Str::random(10);

        $this->actingAs($user)
            ->putJson('/auth/githubToken', ['token' => $token])
            ->assertCreated();

        $this->assertEquals($user->user_github_token, $token);
    }

    /** @test */
    public function an_existing_token_is_updated_when_a_new_one_is_added()
    {
        $previous_token = 'hello_github';
        $user = factory(User::class)->create(['github_token' => $previous_token]);

        $this->assertEquals($user->user_github_token, $previous_token);

        $new_token = 'private_repos_now_free';

        $this->actingAs($user)
            ->putJson('/auth/githubToken', ['token' => $new_token])
            ->assertCreated();

        $this->assertNotEquals($user->fresh()->user_github_token, $previous_token);

        $this->assertEquals($user->user_github_token, $new_token);
    }

    /** @test */
    public function an_unauthenticated_user_cannot_add_a_token()
    {
        $this->putJson('/auth/githubToken', ['token' => Str::random(10)])
            ->assertUnauthorized();
    }
}
