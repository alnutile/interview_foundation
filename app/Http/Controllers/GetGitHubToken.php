<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GetGitHubToken extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (auth()->user()->git_hub_token) {
            return substr(Crypt::decryptString(auth()->user()->git_hub_token), -42, 40);
        }else{
            return 'no_token';
        }
    }
}
