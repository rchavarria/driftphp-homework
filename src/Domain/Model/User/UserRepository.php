<?php

namespace Domain\Model\User;

use App\Domain\Model\User\UserNotFoundException;
use React\Promise\PromiseInterface;
use function React\Promise\reject;
use function React\Promise\resolve;

interface UserRepository
{

    /**
     * @param string $uid
     *
     * @return PromiseInterface<User>
     *
     * @throws UserNotFoundException
     */
    public function find(string $uid): PromiseInterface;

    /**
     * @param User $user
     *
     * @return PromiseInterface
     */
    public function save(User $user): PromiseInterface;

    /**
     * @param string $uid
     *
     * @return PromiseInterface
     */
    public function delete(string $uid): PromiseInterface;
}
