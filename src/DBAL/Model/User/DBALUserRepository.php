<?php

namespace Infrastructure\DBAL\Model\User;

use App\Domain\Model\User\UserNotFoundException;
use Domain\Model\User\User;
use Domain\Model\User\UserRepository;
use Drift\DBAL\Connection;
use Drift\DBAL\Result;
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
        $queryBuilder = $this
            ->connection
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->where('uid = ?')
            ->setParameters([$uid]);

        return $this
            ->connection
            ->query($queryBuilder)
            ->then(function (Result $result) {
                $userAsArray = $result->fetchFirstRow();
                if (is_null($userAsArray)) {
                    throw new UserNotFoundException();
                }

                return new User(
                    $userAsArray['uid'],
                    $userAsArray['name']
                );
            });
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
