<?php

namespace Test\Domain\Model\User;

use App\Domain\Model\User\UserNotFoundException;
use Domain\Model\User\InMemoryUserRepository;
use Domain\Model\User\User;
use PHPUnit\Framework\TestCase;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use function Clue\React\Block\await;

abstract class UserRepositoryTest extends TestCase
{
    /** @var LoopInterface */
    private $loop;

    public function setUp() {
        $this->loop = Factory::create();
    }

    protected abstract function createRepository(): InMemoryUserRepository;

    public function testUserNotFound()
    {
        $repository = $this->createRepository();
        $promise = $repository->find('user-uid');

        $this->expectException(UserNotFoundException::class);
        await($promise, $this->loop);
    }

    public function testGetUser()
    {
        $repository = $this->createRepository();
        $user = new User('user-uid', 'user-name');
        $found = $repository
            ->save($user)
            ->then(function () use ($repository, $user) {
                return $repository->find($user->getUid());
            });

        $this->assertEquals($user, await($found, $this->loop));
    }

    public function testPutUserTwice()
    {
        $expectedUid = 'user-guid';
        $repository = $this->createRepository();
        $user1 = new User($expectedUid, 'user-name-#1');
        $user2 = new User($expectedUid, 'user-name-#2');

        $found = $repository
            ->save($user1)
            ->then(function () use ($repository, $expectedUid, $user2) {
                return $repository->save($user2);
            })
            ->then(function () use ($repository, $expectedUid) {
                return $repository->find($expectedUid);
            });

        $this->assertEquals($user2, await($found, $this->loop), 'Should be the latest saved user');
    }

    public function testDeleteUser() {
        $repository = $this->createRepository();
        $user = new User('user-uid', 'user-name');
        $promise = $repository
            ->save($user)
            ->then(function () use ($repository, $user) {
                return $repository->delete($user->getUid());
            })
            ->then(function () use ($repository, $user) {
                return $repository->find($user->getUid());
            });

        $this->expectException(UserNotFoundException::class);
        await($promise, $this->loop);
    }

    public function testDeleteNonExistentUser()
    {
        $this->expectNotToPerformAssertions();

        $repository = $this->createRepository();
        await($repository->delete('user-uid'), $this->loop);
    }
}
