<?php
namespace Tests\Dnshio\Domain\Github;

use Dnshio\Domain\Github\HopCounter;
use Dnshio\Domain\Github\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HopCounterTest extends KernelTestCase
{
    /**
     * @var HopCounter
     */
    private $hopCounter;

    public function setUp()
    {
        self::bootKernel();
        $this->hopCounter = static::$kernel->getContainer()->get('dnshio.github.hop_counter');
    }

    /**
     *  [1] -> [2] -> [3] = 2 edges as opposed to:
     *  [1] -> [2] -> [5] -> [3] = 3 edges
     */
    public function testShortestPathBetweenTwoConnectedNodes()
    {
        $start = new User(1, 'dnshio');
        $end = new User(3, 'Seldaek');

        $hopCount = $this->hopCounter->getHopCount($start, $end);

        $this->assertEquals(2, $hopCount);
    }

    public function testShortestPathBetweenTwoConnectedNodes2()
    {
        $start = new User(3, 'dnshio');
        $end = new User(9, 'Seldaek');

        $hopCount = $this->hopCounter->getHopCount($start, $end);

        $this->assertEquals(3, $hopCount);
    }

    public function testHopCountBetweenDisconnectedNodes()
    {
        $start = new User(1, 'dnshio');
        $end = new User(4, 'lonewolf');

        $hopCount = $this->hopCounter->getHopCount($start, $end);

        $this->assertEquals(null, $hopCount);
    }



}