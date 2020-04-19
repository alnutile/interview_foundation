<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class GetGithubToken extends Controller
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
        $user = Auth::user();
        $tk = $user->decryptedGithubToken();
        if ($tk) {
            return response()->json([
                'message' => 'ok',
                'github_token' => $tk
            ]);
        } else {
            return [
                'message' => 'error'
            ];
        }
    }
}
