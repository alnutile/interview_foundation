<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\GitHub\GitHubFactory;
use Auth;
use Log;

class GithubCallback extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $github_token = Auth::user()->decryptedGithubToken();

        if ($github_token) {
            $client = app(GitHubFactory::class)->make([
                'method'     => 'token',
                'token'      => $github_token,
                'cache'     => true,
                'backoff'   => true
            ]);
            try {
                return $client->api('current_user')->starring()->all();
            } catch (Exception $e) {
                Log::error($e);
            }
        }

        return response()->json([
            'message' => 'error'
        ]);
    }
}
