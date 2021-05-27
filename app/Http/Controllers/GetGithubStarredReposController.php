<?php

namespace App\Http\Controllers;

use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetGithubStarredReposController extends Controller
{
    /**
     * @var \GrahamCampbell\GitHub\GitHubManager
     */
    protected $github;

    /**
     * GetGithubStarredReposController constructor.
     *
     * @param  \GrahamCampbell\GitHub\GitHubManager  $gitHubManager
     */
    public function __construct(GitHubManager $gitHubManager)
    {
        $this->github = $gitHubManager;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Github\Api\CurrentUser\Starring|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        if (blank($token = Auth::user()->user_github_token)) {
            return response()->json([
                'message' => 'No github token has been added yet.',
            ], 400);
        }

        try {
            $this->github->authenticate($token, null, \Github\Client::AUTH_ACCESS_TOKEN);

            $starring = optional($this->github->me())->starring();

            return response()->json([
                'message' => 'Got the repositories successfully',
                'repositories' => optional($starring)->all(),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }
}
