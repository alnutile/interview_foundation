<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Session;

class UserGithubTokenTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCanSaveGithubKey(){

        Session::start();
        $user = factory('App\User')->create();
        $response = $this->actingAs($user)->post('/saveGithubToken', [
            'github_token' => 'Example-github-token',
            '_token' => csrf_token()
        ]);

        $response->assertStatus(200);
    }

    public function testUserCanGetGithubKey(){
        Session::start();
        $user = factory('App\User')->create([
            'github_token' => encrypt('hello world')
        ]);

        $response = $this->actingAs($user)->get('/getGithubToken');

        $response->assertStatus(200);

        $user2 = factory('App\User')->create();

        $response = $this->actingAs($user2)->get('/getGithubToken');
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'error',
            ]);
    }
}
