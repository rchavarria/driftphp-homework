<?php

namespace App\Controller;

use Domain\Query\GetUser;
use Drift\CommandBus\Bus\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetUserController
{

    /** @var QueryBus */
    private $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request)
    {
        $uid = $request->get('uid');

        return $this->queryBus
            ->ask(new GetUser($uid))
            ->then(function ($user) {
                $userAsArray = [
                    'uid' => $user->getUid(),
                    'name' => $user->getName()
                ];
                return new JsonResponse($userAsArray, 200);
            });
    }
}
