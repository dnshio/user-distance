<?php
namespace Dnshio\Bridge\Github;

use Dnshio\Bridge\Doctrine\Repository\GithubApiRepository;
use Dnshio\Domain\Github\Api;
use Dnshio\Domain\Github\Repository;
use Dnshio\Domain\Github\User;

class TestApi implements Api
{
    /**
     * @var GithubApiRepository
     */
    private $mockDataRepo;

    public function __construct(GithubApiRepository $mockDataRepo)
    {
        $this->mockDataRepo = $mockDataRepo;
    }

    public function getRepositories(User $user)
    {
        return $this->mockDataRepo->findRepositoriesByUserId($user->getId());
    }

    public function getContributors(Repository $repository)
    {
        return $this->mockDataRepo->findUsersByRepositoryId($repository->getId());
    }

    public function findUserByUserName($username)
    {
        return $this->mockDataRepo->findUserByName($username);
    }

}