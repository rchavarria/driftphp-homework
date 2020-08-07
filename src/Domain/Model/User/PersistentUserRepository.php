<?php

namespace Domain\Model\User;

use React\Promise\PromiseInterface;

interface PersistentUserRepository extends UserRepository
{
    public function findAll(): PromiseInterface;
}
