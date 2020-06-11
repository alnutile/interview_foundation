<?php

namespace App\Services;

use GrahamCampbell\GitHub\GitHubManager;

class GithubService
{
    /**
     * @var GitHubManager
     */
    protected $github;

    public function __construct(GithubManager $github)
    {
        $this->github = $github;
    }

    public function getStarredRepos($token)
    {
        $client = $this->github->getFactory()->make([
            'method' => 'token',
            'token' => $token,
            'name' => 'main'
        ]);

        return $client->currentUser()->starring()->all();
    }
}
