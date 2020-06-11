<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Services\GithubService;

class GithubController extends Controller
{
    public function saveToken(Request $request)
    {
        try {
            $token = Crypt::encrypt($request->post('token'));
            $user = $request->user();
            $user->github_token = $token;

            $user->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        return response()->json(['success' => true]);
    }

    public function starred(GithubService $service, Request $request)
    {
        $token = $request->post('token');

        $repos = $service->getStarredRepos($token);

        return response()->json($repos);
    }
}
