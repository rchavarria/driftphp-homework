<?php

namespace Domain\Middleware;

use Domain\Command\PutUser;
use Drift\CommandBus\Middleware\DiscriminableMiddleware;
use React\Promise\PromiseInterface;

class PutUserLogger implements DiscriminableMiddleware
{

    public function execute(PutUser $command, callable $next): PromiseInterface {
        $uid = $command->getUser()->getUid();
        $name = $command->getUser()->getName();
        echo "MDW > User [$uid] with name [$name] will be saved", PHP_EOL;

        return $next($command);
    }

    public function onlyHandle(): array
    {
        return [
            PutUser::class
        ];
    }
}
