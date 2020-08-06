<?php

namespace App\Controller;

use App\Controller\Transformer\UserTransformer;
use App\Domain\Model\User\UserNotFoundException;
use Domain\Query\GetUser;
use Drift\CommandBus\Bus\QueryBus;
use React\Promise\PromiseInterface;
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

    public function __invoke(Request $request): PromiseInterface
    {
        $uid = $request->get('uid');

        return $this->queryBus
            ->ask(new GetUser($uid))
            ->then(function ($user) {
                $userAsArray = UserTransformer::toArray($user);
                return new JsonResponse($userAsArray, 200);
            })
            ->otherwise(function (UserNotFoundException $e) {
                return new JsonResponse('User not found', 404);
            });
    }

}
