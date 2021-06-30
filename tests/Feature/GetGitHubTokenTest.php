<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetGitHubTokenTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetGitHubToken()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)
            ->get('/githubtoken');
        $this->assertEquals(200,$response->getStatusCode());
    }
}
