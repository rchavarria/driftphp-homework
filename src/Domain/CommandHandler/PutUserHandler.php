<?php

namespace Domain\CommandHandler;

use Domain\Command\PutUser;
use Domain\Event\UserWasSaved;
use Domain\Model\User\UserRepository;
use Drift\EventBus\Bus\EventBus;
use React\Promise\PromiseInterface;

class PutUserHandler
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

    public function handle(PutUser $putUser): PromiseInterface
    {
        return $this
            ->repository
            ->save($putUser->getUser())
            ->then(function () use ($putUser) {
                return $this
                    ->eventBus
                    ->dispatch(new UserWasSaved($putUser->getUser()));
            });
    }
}
