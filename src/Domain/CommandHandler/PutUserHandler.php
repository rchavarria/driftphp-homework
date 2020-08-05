<?php

namespace Domain\CommandHandler;

use Domain\Command\PutUser;
use React\Promise\PromiseInterface;
use function React\Promise\resolve;

class PutUserHandler
{

    public function handle(PutUser $putUser): PromiseInterface
    {
        $uid = $putUser->getUser()->getUid();
        $name = $putUser->getUser()->getName();
        echo "User [$uid] with name [$name] will be saved", PHP_EOL;

        return resolve();
    }
}
