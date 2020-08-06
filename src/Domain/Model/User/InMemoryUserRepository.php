<?php

namespace Domain\Model\User;

use App\Domain\Model\User\UserNotFoundException;

class InMemoryUserRepository
{

    /** @var array */
    private $users;

    public function find(string $uid): User
    {
        if (!isset($this->users[$uid])) {
            throw new UserNotFoundException("User [$uid] not found");
        }

        return $this->users[$uid];
    }

    public function save(User $user): void
    {
        $this->users[$user->getUid()] = $user;
    }

    public function delete(string $uid): void
    {
        unset($this->users[$uid]);
    }
}
