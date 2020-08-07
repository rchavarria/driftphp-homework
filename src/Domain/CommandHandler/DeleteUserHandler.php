<?php

namespace Domain\CommandHandler;

use App\Domain\Event\UserWasDeleted;
use Domain\Command\DeleteUser;
use Domain\Model\User\UserRepository;
use Drift\EventBus\Bus\EventBus;
use React\Promise\PromiseInterface;

class DeleteUserHandler
{
    /** @var UserRepository */
    private $repository;
    /** @var EventBus */
    private $eventBus;

    public function __construct(UserRepository $repository, EventBus $eventBus)
    {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function handle(DeleteUser $deleteUser): PromiseInterface
    {
        return $this
            ->repository
            ->delete($deleteUser->getUid())
            ->then(function () use ($deleteUser) {
                return $this
                    ->eventBus
                    ->dispatch(new UserWasDeleted($deleteUser->getUid()));
            });
    }
}
