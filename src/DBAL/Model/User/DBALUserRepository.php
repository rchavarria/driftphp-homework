<?php

namespace Infrastructure\DBAL\Model\User;

use App\Domain\Model\User\UserNotFoundException;
use Domain\Model\User\PersistentUserRepository;
use Domain\Model\User\User;
use Drift\DBAL\Connection;
use Drift\DBAL\Result;
use React\Promise\PromiseInterface;

class DBALUserRepository implements PersistentUserRepository
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
        $ids = [
            'uid' => $user->getUid()
        ];
        $columns = [
            'name' => $user->getName()
        ];

        return $this
            ->connection
            ->upsert('users', $ids, $columns);
    }

    public function delete(string $uid): PromiseInterface
    {
        return $this
            ->connection
            ->delete('users', ['uid' => $uid]);
    }

    public function findAll(): PromiseInterface
    {
        $queryBuilder = $this
            ->connection
            ->createQueryBuilder()
            ->select('*')
            ->from('users');

        return $this
            ->connection
            ->query($queryBuilder)
            ->then(function (Result $result) {
                $usersAsArray = $result->fetchAllRows();

                $users = [];
                foreach ($usersAsArray as $userAsArray) {
                    $users[] = new User(
                        $userAsArray['uid'],
                        $userAsArray['name']
                    );
                }

                return $users;
            });
    }
}
