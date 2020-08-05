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
        return resolve(new User($getUser->getUid(), 'Fulanito'));
    }
}
