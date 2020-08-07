<?php

namespace Domain\Model\User;

use React\Promise\PromiseInterface;

class ComposedUserRepository implements UserRepository
{

    /** @var InMemoryUserRepository */
    private $memory;
    /** @var PersistentUserRepository */
    private $persistent;

    public function __construct(InMemoryUserRepository $memory, PersistentUserRepository $persistent)
    {
        $this->memory = $memory;
        $this->persistent = $persistent;
    }

    public function find(string $uid): PromiseInterface
    {
        return $this->memory->find($uid);
    }

    public function save(User $user): PromiseInterface
    {
        return $this->persistent->save($user);
    }

    public function delete(string $uid): PromiseInterface
    {
        return $this->persistent->delete($uid);
    }
}
