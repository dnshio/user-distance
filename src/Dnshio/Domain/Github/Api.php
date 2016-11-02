<?php
namespace Dnshio\Domain\Github;

interface Api
{
    /**
     * @param $username
     * @return null|User
     */
    public function findUserByUserName($username);

    /**
     * @param User $user
     * @return Repository[]
     */
    public function getRepositories(User $user);

    /**
     * @param Repository $repository
     * @return User[]
     */
    public function getContributors(Repository $repository);
}