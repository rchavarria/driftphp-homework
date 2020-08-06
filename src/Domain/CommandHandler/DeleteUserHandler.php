<?php

namespace Domain\CommandHandler;

use Domain\Command\DeleteUser;
use Domain\Model\User\UserRepository;
use React\Promise\PromiseInterface;

class DeleteUserHandler
{
    /** @var UserRepository */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(DeleteUser $deleteUser): PromiseInterface
    {
        $uid = $deleteUser->getUid();
        echo "User [$uid] will be deleted", PHP_EOL;

        return $this->repository->delete($deleteUser->getUid());
    }
}
