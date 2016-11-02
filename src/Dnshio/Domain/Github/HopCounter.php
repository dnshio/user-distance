<?php
namespace Dnshio\Domain\Github;

class HopCounter
{
    /**
     * @var Api
     */
    private $api;

    /**
     * @var User[]
     */
    private $usersToVisit = [];

    /**
     * @var int[]
     */
    private $visited = [];

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    private function reset()
    {
        $this->usersToVisit = [];
        $this->visited = [];
    }

    /**
     * This method attempts to find the shortest path between two users using Breadth First Search.
     * Users are treated as vertices and repositories as edges
     * The first iteration
     * @param User $start
     * @param User $end
     * @param int $depth
     * @return int|null
     */
    public function getHopCount(User $start, User $end, $depth = 1)
    {
        if ($depth <= 1) {
            $this->reset();
        }
        $this->visited[] = $start->getId();
        $repositories = $this->api->getRepositories($start);

        foreach ($repositories as $repository) {
            $contributors = $this->api->getContributors($repository);
            foreach ($contributors as $contributor) {
                if ($contributor->getId() == $end->getId()) {
                    return $depth;
                }
                if (!in_array($contributor->getId(), $this->visited)) {
                    $this->usersToVisit[] = $contributor;
                }
            }
        }

        if (count($this->usersToVisit)) {
            return $this->getHopCount(array_pop($this->usersToVisit), $end, $depth + 1);
        }

        return null;
    }

}
