<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class GithubEncryptController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $token = $request->input('token');

        if ($token) {
            $encryptedToken = Crypt::encryptString($token);
            $user->update(['github_token' => $encryptedToken]);
            return response()->json(['message' => 'Token saved successfully']);
        }

        return response()->json(['error' => 'Token is required'], 400);
    }
}
