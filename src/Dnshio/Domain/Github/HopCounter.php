<?php
namespace Dnshio\Domain\Github;

class HopCounter
{
    /**
     * @var Api
     */
    private $api;

    /**
     * @var UserQueue
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
        $this->usersToVisit = new UserQueue();
        $this->usersToVisit->setExtractFlags(\SplPriorityQueue::EXTR_BOTH);
        $this->visited = [];
    }

    /**
     * This method attempts to find the shortest path between two users using Breadth First Search.
     * Users are treated as vertices and repositories as edges
     * The first iteration
     * @param User $start
     * @param User $end
     * @return int|null
     */
    public function getHopCount(User $start, User $end)
    {
        $this->reset();
        $this->usersToVisit->insert($start, 1);
        $this->visited[] = $start->getId();

        while (!$this->usersToVisit->isEmpty()) {
            $item = $this->usersToVisit->extract();
            $node = $item['data'];
            $depth = $item['priority'];

            $this->visited[] = $node->getId();

            $repositories = $this->api->getRepositories($node);

            foreach ($repositories as $repository) {
                $contributors = $this->api->getContributors($repository);
                foreach ($contributors as $contributor) {
                    if ($contributor->getId() == $end->getId()) {
                        return $depth;
                    }
                    if (!in_array($contributor->getId(), $this->visited)) {
                        $this->usersToVisit->insert($contributor, $depth + 1);
                        $this->visited[] = $contributor->getId();
                    }
                }
            }
        }
        return null;
    }


}
