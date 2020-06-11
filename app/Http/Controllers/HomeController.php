<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $userGithubToken = Auth::user()->github_token;
            if (empty($userGithubToken)) {
                return view('home', [
                    'token' => ''
                ]);
            }
            $token = Crypt::decrypt($userGithubToken);
            return view('home', [
                'token' => $token
            ]);
        } catch (DecryptException $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
}
