<?php

namespace Test\Domain\Model\User;

use Domain\Model\User\InMemoryUserRepository;
use Domain\Model\User\UserRepository;
use React\EventLoop\LoopInterface;

class InMemoryUserRepositoryTest extends UserRepositoryTest
{
    protected function createRepository(LoopInterface $loop): UserRepository
    {
        return new InMemoryUserRepository();
    }
}
