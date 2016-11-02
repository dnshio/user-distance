<?php
namespace Dnshio\Bundle\GithubBundle\Controller;

use Dnshio\Domain\Github\Api;
use Dnshio\Domain\Github\HopCounter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route(service="dnshio.controller.github_default")
 */
class DefaultController extends Controller
{
    /**
     * @var HopCounter
     */
    private $counter;
    /**
     * @var Api
     */
    private $api;

    public function __construct(HopCounter $counter, Api $api)
    {
        $this->counter = $counter;
        $this->api = $api;
    }

    /**
     * @Route("/user/{userA}/distance/{userB}", name="hops")
     * @Method({"GET"})
     * @return Response
     */
    public function hopCountAction($userA, $userB)
    {
        $userA = $this->api->findUserByUserName($userA);
        $userB = $this->api->findUserByUserName($userB);

        $hopCount = $this->counter->getHopCount($userA, $userB);
        return new JsonResponse([
            'hop_count' => $hopCount
        ]);
    }

    public function indexAction()
    {
        return $this->render('DnshioGithubBundle:Default:index.html.twig');
    }
}
