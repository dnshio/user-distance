<?php
namespace Dnshio\Domain\Github;

class UserQueue extends \SplPriorityQueue
{
    /*
     * Lower the number, higher the priority
     */
    public function compare($priority1, $priority2)
    {
        if ($priority1 === $priority2) return 0;
        return $priority1 > $priority2 ? -1 : 1;
    }
}