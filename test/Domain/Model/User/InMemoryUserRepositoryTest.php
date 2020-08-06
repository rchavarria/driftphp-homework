<?php

namespace Test\Domain\Model\User;

use App\Domain\Model\User\UserNotFoundException;
use Domain\Model\User\InMemoryUserRepository;
use Domain\Model\User\User;
use Exception;
use PHPUnit\Framework\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{
    public function testUserNotFound()
    {
        $repository = $this->createRepository();
        $this->expectException(UserNotFoundException::class);
        $repository->find('user-uid');
    }

    public function testGetUser()
    {
        $repository = $this->createRepository();
        $user = new User('user-uid', 'user-name');
        $repository->save($user);

        $found = $repository->find($user->getUid());
        $this->assertEquals($user, $found);
    }

    private function createRepository(): InMemoryUserRepository
    {
        return new InMemoryUserRepository();
    }
}
