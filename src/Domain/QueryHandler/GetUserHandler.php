<?php

namespace Domain\QueryHandler;

use Domain\Model\User\UserRepository;
use Domain\Query\GetUser;
use React\Promise\PromiseInterface;

class GetUserHandler
{
    /** @var UserRepository */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(GetUser $getUser): PromiseInterface
    {
        $uid = $getUser->getUid();
        echo "Searching user [$uid]", PHP_EOL;

        return $this->repository->find($getUser->getUid());
    }
}
