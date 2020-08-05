<?php

namespace Domain\QueryHandler;

use Domain\Query\GetUser;
use Domain\Model\User\User;

class GetUserHandler
{

    public function handle(GetUser $getUser)
    {
        return new User($getUser->getUid(), 'Fulanito');
    }
}
