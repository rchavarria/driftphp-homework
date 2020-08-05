<?php

namespace Test\Domain\Model\User;

use Domain\Model\User\InMemoryUserRepository;
use Exception;
use PHPUnit\Framework\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{
    public function testUserNotFound()
    {
        $repository = $this->createRepository();
        $this->expectException(Exception::class);
        $repository->find('user-uid');
    }

    private function createRepository(): InMemoryUserRepository
    {
        return new InMemoryUserRepository();
    }
}
