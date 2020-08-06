<?php

namespace Infrastructure\DBAL\Model\User;

use Domain\Model\User\User;
use Domain\Model\User\UserRepository;
use Drift\DBAL\Connection;
use React\Promise\PromiseInterface;

class DBALUserRepository implements UserRepository
{
    /** @var Connection */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function find(string $uid): PromiseInterface
    {
        // TODO: Implement find() method.
    }

    public function save(User $user): PromiseInterface
    {
        // TODO: Implement save() method.
    }

    public function delete(string $uid): PromiseInterface
    {
        // TODO: Implement delete() method.
    }
}
