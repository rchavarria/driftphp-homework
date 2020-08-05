<?php

namespace Domain\QueryHandler;

use Domain\Query\GetUser;
use Domain\Model\User\User;
use React\Promise\PromiseInterface;
use function React\Promise\resolve;

class GetUserHandler
{

    public function handle(GetUser $getUser): PromiseInterface
    {
        $uid = $getUser->getUid();
        echo "Searching user [$uid]", PHP_EOL;

        return resolve(new User($uid, 'Fulanito'));
    }
}
