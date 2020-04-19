<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SaveGithubToken extends Controller
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
        $request->validate([
            'github_token' => ['required','string']
        ]);

        $user = Auth::user();

        if($user->setGithubToken($request->github_token))
        {
            return response()->json([
                'message' => 'ok'
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'error'
            ]);
        }


    }
}
