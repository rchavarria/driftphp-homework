<?php

namespace Domain\Middleware;

use Domain\Query\GetUser;
use Drift\CommandBus\Middleware\DiscriminableMiddleware;
use React\Promise\PromiseInterface;

class GetUserLogger implements DiscriminableMiddleware
{
    public function execute(GetUser $query, callable $next): PromiseInterface
    {
        $uid = $query->getUid();
        echo "MDW > Searching user [$uid]", PHP_EOL;

        return $next($query);
    }

    public function onlyHandle(): array
    {
        return [
            GetUser::class
        ];
    }
}
