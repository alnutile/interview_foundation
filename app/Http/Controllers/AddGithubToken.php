<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AddGithubToken extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(TokenRequest $request)
    {
        $user = $request->user();

        $user->fill(['github_token' => Crypt::encryptString($request->token),])->save();

        return new UserResource($user);
    }
}
