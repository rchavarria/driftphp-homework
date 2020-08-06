<?php

namespace Test\Domain\Model\User;

use App\Domain\Model\User\UserNotFoundException;
use Domain\Model\User\InMemoryUserRepository;
use Domain\Model\User\User;
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

    public function testPutUserTwice()
    {
        $expectedUid = 'user-guid';
        $repository = $this->createRepository();
        $user1 = new User($expectedUid, 'user-name');
        $repository->save($user1);
        $user2 = new User($expectedUid, 'user-name');
        $repository->save($user2);

        $found = $repository->find($expectedUid);
        $this->assertEquals($user2, $found, 'Should be the latest saved user');
    }

    public function testDeleteUser() {
        $repository = $this->createRepository();
        $user = new User('user-uid', 'user-name');
        $repository->save($user);
        $repository->delete($user->getUid());

        $this->expectException(UserNotFoundException::class);
        $repository->find($user->getUid());
    }

    private function createRepository(): InMemoryUserRepository
    {
        return new InMemoryUserRepository();
    }
}
