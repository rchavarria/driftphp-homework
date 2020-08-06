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
        return $this->repository->save($putUser->getUser());
    }
}
