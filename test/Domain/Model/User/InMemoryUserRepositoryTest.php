<?php

namespace Test\Domain\Model\User;

use Domain\Model\User\InMemoryUserRepository;

class InMemoryUserRepositoryTest extends UserRepositoryTest
{
    protected function createRepository(): InMemoryUserRepository
    {
        return new InMemoryUserRepository();
    }
}
