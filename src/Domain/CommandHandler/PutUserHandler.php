<?php

namespace Domain\CommandHandler;

use Domain\Command\PutUser;
use Domain\Model\User\UserRepository;
use React\Promise\PromiseInterface;

class PutUserHandler
{

    /** @var UserRepository */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(PutUser $putUser): PromiseInterface
    {
        $uid = $putUser->getUser()->getUid();
        $name = $putUser->getUser()->getName();
        echo "User [$uid] with name [$name] will be saved", PHP_EOL;

        return $this->repository->save($putUser->getUser());
    }
}
