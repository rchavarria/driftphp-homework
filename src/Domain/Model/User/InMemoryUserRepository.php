<?php

namespace Domain\Model\User;

use Exception;

class InMemoryUserRepository
{

    public function find(string $uid): User
    {
        throw new Exception("User [$uid] not found");
    }
}
