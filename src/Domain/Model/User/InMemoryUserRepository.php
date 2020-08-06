<?php

namespace Domain\Model\User;

use App\Domain\Model\User\UserNotFoundException;
use React\Promise\PromiseInterface;
use function React\Promise\reject;
use function React\Promise\resolve;

class InMemoryUserRepository
{

    /** @var array */
    private $users;

    /**
     * @param string $uid
     *
     * @return PromiseInterface<User>
     *
     * @throws UserNotFoundException
     */
    public function find(string $uid): PromiseInterface
    {
        if (!isset($this->users[$uid])) {
            return reject(new UserNotFoundException("User [$uid] not found"));
        }

        return resolve($this->users[$uid]);
    }

    /**
     * @param User $user
     *
     * @return PromiseInterface
     */
    public function save(User $user): PromiseInterface
    {
        $this->users[$user->getUid()] = $user;
        return resolve();
    }

    /**
     * @param string $uid
     *
     * @return PromiseInterface
     */
    public function delete(string $uid): PromiseInterface
    {
        unset($this->users[$uid]);
        return resolve();
    }
}
