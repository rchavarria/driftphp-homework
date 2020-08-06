<?php

namespace Domain\Middleware;

use Domain\Command\DeleteUser;
use Drift\CommandBus\Middleware\DiscriminableMiddleware;
use React\Promise\PromiseInterface;

class DeleteUserLogger implements DiscriminableMiddleware
{

    public function execute(DeleteUser $command, callable $next): PromiseInterface {
        $uid = $command->getUid();
        echo "MDW > User [$uid] will be deleted", PHP_EOL;

        return $next($command);
    }

    public function onlyHandle(): array
    {
        return [
            DeleteUser::class
        ];
    }
}
