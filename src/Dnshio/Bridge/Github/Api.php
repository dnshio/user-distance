<?php
namespace Dnshio\Bridge\Github;

use Dnshio\Domain\Github\Api as GithubApiInterface;
use Dnshio\Domain\Github\Repository;
use Dnshio\Domain\Github\User;

class Api implements GithubApiInterface
{
    public function findUserByUserName($username)
    {
        // TODO: Implement this service call
    }

    public function getRepositories(User $user)
    {
        // TODO: Implement this service call
    }

    public function getContributors(Repository $repository)
    {
        // TODO: Implement this service call
    }

}
