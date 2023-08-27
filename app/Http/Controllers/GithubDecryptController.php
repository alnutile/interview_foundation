<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Services\GitHubService;
use Illuminate\Support\Facades\Crypt;

class GithubDecryptController extends Controller
{
    /*protected $gitHubService;

    public function __construct(GitHubService $gitHubService)
    {
        $this->gitHubService = $gitHubService;
    }*/
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $user = auth()->user();
        if ($user && $user->github_token) {
            $decryptedToken = Crypt::decrypt($user->github_token);
            return response()->json(['token' => $decryptedToken]);
        }
    
        return response()->json(['message' => 'No decrypted token available'], 404);
    }
}
