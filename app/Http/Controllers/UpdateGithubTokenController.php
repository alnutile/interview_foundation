<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateGithubTokenController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'token' => 'required',
        ]);

        $user = Auth::user();

        $user->update(['github_token' => $data['token']]);

        return response()->json([
            'message' => 'Token has been updated successfully',
            'token' => $user->fresh()->user_github_token,
        ], 201);
    }
}
