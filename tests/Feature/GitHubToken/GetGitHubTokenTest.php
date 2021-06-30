<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
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
        $user = factory(\App\User::class)->create([
            'git_hub_token' => Crypt::encrypt('gcp_waHOh7fA2HXa44tDeMtSlD2atzAxaE071TVB')
        ]);
        $response = $this->actingAs($user)
            ->get('/githubtoken');
        $this->assertNotEquals('no_token',$response->original);
    }

    public function testGetNoToken()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)
            ->get('/githubtoken');
        $this->assertEquals('no_token',$response->original);
    }
}
