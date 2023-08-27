<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;

class GitHubService
{
    public function encryptToken($token)
    {
        return Crypt::encryptString($token);
    }

    public function decryptToken($encryptedToken)
    {
        return Crypt::decryptString($encryptedToken);
    }
}