<?php

namespace Tests\Unit\App\Services;

use App\Services\GithubService;
use GrahamCampbell\GitHub\GitHubFactory;
use GrahamCampbell\GitHub\GitHubManager;
use Github\Client as GithubClient;
use Github\Api\CurrentUser as CurrentUserApi;
use Github\Api\CurrentUser\Starring;
use Tests\TestCase;

class GithubServiceTest extends TestCase
{
    protected function setUp(): void
    {
        $this->token = 'token-tes-1234567890abcdef';
        $this->starredRepos = require __DIR__ . '/../../../fixtures/starred-repos.php';

        $starringMock = $this->getMockBuilder(Starring::class)
            ->disableOriginalConstructor()
            ->setMethods(['all'])
            ->getMock();
        $starringMock->expects($this->once())
            ->method('all')
            ->willReturn($this->starredRepos);

        $apiMock = $this->getMockBuilder(CurrentUserApi::class)
            ->disableOriginalConstructor()
            ->setMethods(['starring'])
            ->getMock();
        $apiMock->expects($this->once())
            ->method('starring')
            ->willReturn($starringMock);

        $clientMock = $this->getMockBuilder(GithubClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['currentUser'])
            ->getMock();
        $clientMock->expects($this->once())
            ->method('currentUser')
            ->willReturn($apiMock);

        $factoryMock = $this->getMockBuilder(GitHubFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['make'])
            ->getMock();
        $factoryMock->expects($this->once())
            ->method('make')
            ->with([
                'method' => 'token',
                'token' => $this->token,
                'name' => 'main'
            ])
            ->willReturn($clientMock);

        $githubManagerMock = $this->getMockBuilder(GitHubManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getFactory'])
            ->getMock();
        $githubManagerMock->expects($this->once())
            ->method('getFactory')
            ->willReturn($factoryMock);
        $this->githubManagerMock = $githubManagerMock;
    }

    public function testGetStarredRepos()
    {
        $service = new GithubService($this->githubManagerMock);
        $repos = $service->getStarredRepos($this->token);

        $this->assertCount(2, $repos);
    }
}
