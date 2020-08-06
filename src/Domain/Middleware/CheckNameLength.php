<?php

namespace Domain\Middleware;

use App\Domain\Model\User\NameTooShortException;
use Domain\Command\PutUser;
use Drift\CommandBus\Middleware\DiscriminableMiddleware;
use React\Promise\PromiseInterface;
use function React\Promise\reject;

class CheckNameLength implements DiscriminableMiddleware
{
    public function execute(PutUser $command, callable $next): PromiseInterface
    {
        $name = $command->getUser()->getName();
        if (strlen($name) < 5) {
            return reject(new NameTooShortException());
        }
        return $next($command);
    }

    public function onlyHandle(): array
    {
        return [
            PutUser::class
        ];
    }
}
