<?php

namespace Domain\Model\User;

use App\Domain\Event\UserWasDeleted;
use Domain\Event\UserWasSaved;
use Drift\HttpKernel\AsyncKernelEvents;
use React\Promise\PromiseInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ComposedUserRepository implements UserRepository, EventSubscriberInterface
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

    public function loadAllUsersToMemory(): void
    {
        echo '*** load all users into memory', PHP_EOL;

        $this
            ->persistent
            ->findAll()
            ->then(function ($users) {
                $this
                    ->memory
                    ->loadAllFromArray($users);
            });
    }

    public static function getSubscribedEvents()
    {
        return [
            UserWasSaved::class => [
                ['loadAllUsersToMemory', 0]
            ],
            UserWasDeleted::class => [
                ['loadAllUsersToMemory', 0]
            ],
            AsyncKernelEvents::PRELOAD => [
                ['loadAllUsersToMemory', 0]
            ]
        ];
    }
}
