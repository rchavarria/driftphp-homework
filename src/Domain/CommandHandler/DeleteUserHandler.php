<?php

namespace Domain\CommandHandler;

use Domain\Command\DeleteUser;
use React\Promise\PromiseInterface;
use function React\Promise\resolve;

class DeleteUserHandler
{

    public function handle(DeleteUser $deleteUser): PromiseInterface
    {
        $uid = $deleteUser->getUid();
        echo "User [$uid] will be deleted", PHP_EOL;

        return resolve();
    }
}
