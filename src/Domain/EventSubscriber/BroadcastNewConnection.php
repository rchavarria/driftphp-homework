<?php

namespace Domain\EventSubscriber;

use Domain\Model\User\PersistentUserRepository;
use Domain\Model\User\User;
use Drift\Websocket\Connection\Connection;
use Drift\Websocket\Event\WebsocketConnectionOpened;
use React\Promise\PromiseInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BroadcastNewConnection implements EventSubscriberInterface
{

    /** @var PersistentUserRepository */
    private $repository;

    /**
     * BroadcastNewConnection constructor.
     * @param PersistentUserRepository $repository
     */
    public function __construct(PersistentUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public static function getSubscribedEvents()
    {
        return [
            WebsocketConnectionOpened::class => [
                ['broadcastNewConnection', 0]
            ]
        ];
    }

    public final function broadcastNewConnection(WebsocketConnectionOpened $event): void
    {
        $this
            ->listUsers()
            ->then(function ($users) use ($event) {
                $hash = Connection::getConnectionHash($event->getNewConnection());
                echo '* broadcast new connection: ', $hash, ' with ', count($users), ' users', PHP_EOL;

                $event
                    ->getConnections()
                    ->broadcast(json_encode([
                        'type' => 'new-connection',
                        'connection' => $hash,
                        'users' => $users
                    ]));
            });
    }

    /**
     * @return PromiseInterface
     */
    private function listUsers(): PromiseInterface
    {
        return $this
            ->repository
            ->findAll()
            ->then(function (array $users) {
                return array_map(function (User $user) {
                    return [
                        'uid' => $user->getUid(),
                        'name' => $user->getName()
                    ];
                }, $users);
            });
    }
}
