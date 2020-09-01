<?php

namespace Domain\Model\User;

use App\Domain\Model\User\UserNotFoundException;
use React\Promise\PromiseInterface;
use function React\Promise\reject;
use function React\Promise\resolve;

class InMemoryUserRepository implements UserRepository
{

    /** @var array */
    private $users;

    public function find(string $uid): PromiseInterface
    {
        if (!isset($this->users[$uid])) {
            return reject(new UserNotFoundException("User [$uid] not found"));
        }

        return resolve($this->users[$uid]);
    }

    public function save(User $user): PromiseInterface
    {
        $this->users[$user->getUid()] = $user;
        return resolve();
    }

    public function delete(string $uid): PromiseInterface
    {
        unset($this->users[$uid]);
        return resolve();
    }

    /**
     * @param User[] $users
     */
    public function loadAllFromArray(array $users): void
    {
        $this->users = [];
        foreach ($users as $user) {
            $this->users[$user->getUid()] = $user;
        }
    }
}
