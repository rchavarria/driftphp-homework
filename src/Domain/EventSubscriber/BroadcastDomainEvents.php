<?php

namespace Domain\EventSubscriber;

use App\Domain\Event\UserWasDeleted;
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

    public final function broadcastUserWasSaved(DomainEventEnvelope $eventEnvelope): void
    {
        /** @var UserWasSaved $event */
        $event = $eventEnvelope->getDomainEvent();

        $uid = $event->getUser()->getUid();
        echo '* broadcast user was saved: ', $uid, PHP_EOL;

        $this
            ->connections
            ->broadcast(json_encode([
                'type' => get_class($event),
                'uid' => $uid,
                'name' => $event->getUser()->getName()
            ]));
    }

    public final function broadcastUserWasDeleted(DomainEventEnvelope $eventEnvelope): void
    {
        /** @var UserWasDeleted $event */
        $event = $eventEnvelope->getDomainEvent();

        $uid = $event->getUid();
        echo '* broadcast user was deleted: ', $uid, PHP_EOL;

        $this
            ->connections
            ->broadcast(json_encode([
                'type' => get_class($event),
                'uid' => $uid
            ]));
    }

    public static function getSubscribedEvents()
    {
        return [
            UserWasSaved::class => [
                ['broadcastUserWasSaved', 0]
            ],
            UserWasDeleted::class => [
                ['broadcastUserWasDeleted', 0]
            ]
        ];
    }

}
