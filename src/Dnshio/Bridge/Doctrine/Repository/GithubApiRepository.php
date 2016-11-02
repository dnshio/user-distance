<?php
namespace Dnshio\Bridge\Doctrine\Repository;

use Dnshio\Domain\Github\Repository;
use Dnshio\Domain\Github\User;
use Doctrine\DBAL\Connection;

class GithubApiRepository
{
    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var string
     */
    private $fixturesPath;

    /**
     * @param Connection $connection
     * @param $fixturesPath
     */
    public function __construct(Connection $connection, $fixturesPath)
    {
        $this->connection = $connection;
        $this->fixturesPath = $fixturesPath;
    }

    /**
     * @param $userId
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findRepositoriesByUserId($userId)
    {
        $sql = '
            SELECT r.id, r.name 
            FROM repository r INNER JOIN user_repository ur ON ur.repository_id = r.id
            WHERE ur.user_id = ?
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $userId);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $repositories = [];
        foreach ($result as $r) {
            $repositories[] = new Repository($r['id'], $r['name']);
        }

        return $repositories;
    }

    /**
     * @param $repositoryId
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findUsersByRepositoryId($repositoryId)
    {
        $sql = '
            SELECT u.id, u.username 
            FROM user u INNER JOIN user_repository ur ON ur.user_id = u.id
            WHERE ur.repository_id = ?
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $repositoryId);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $users = [];
        foreach ($result as $u) {
            $users[] = new User($u['id'], $u['username']);
        }

        return $users;
    }

    /**
     * @param $username
     * @return User
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findUserByName($username)
    {
        $sql = '
            SELECT u.id, u.username 
            FROM user u 
            WHERE u.username = ?
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $username);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($result as $u) {
            return new User($u['id'], $u['username']);
        }

    }

    public function loadTestData()
    {
        $sql = file_get_contents($this->fixturesPath);
        $this->connection->executeUpdate($sql);
    }


}
