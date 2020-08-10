<?php

namespace App\Domain\EventSubscriber;

use Domain\Event\UserWasSaved;
use Drift\HttpKernel\Event\DomainEventEnvelope;
use Drift\Websocket\Connection\Connections;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BroadcastDomainEvents implements EventSubscriberInterface
{

    /** @var Connections */
    private $connections;

    /**
     * BroadcastDomainEvents constructor.
     * @param Connections $eventsConnections
     */
    public function __construct(Connections $eventsConnections)
    {
        $this->connections = $eventsConnections;
    }

    public final function broadcastUserWasCreated(DomainEventEnvelope $eventEnvelope): void
    {
        /** @var UserWasSaved $event */
        $event = $eventEnvelope->getDomainEvent();

        $uid = $event->getUser()->getUid();
        echo '* broadcast user was saved: ', $uid, PHP_EOL;

        $this
            ->connections
            ->broadcast(json_encode([
                'type' => 'user was created',
                'uid' => $uid,
                'name' => $event->getUser()->getName()
            ]));
    }

    public static function getSubscribedEvents()
    {
        return [
            UserWasSaved::class => [
                ['broadcastUserWasCreated', 0]
            ]
        ];
    }

}
