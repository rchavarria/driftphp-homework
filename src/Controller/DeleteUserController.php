<?php

namespace App\Controller;

use Domain\Command\DeleteUser;
use Drift\CommandBus\Bus\CommandBus;
use React\Promise\PromiseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DeleteUserController
{

    /** @var CommandBus */
    private $commandBus;

    /**
     * DeleteUserController constructor.
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): PromiseInterface
    {
        $uid = $request->get('uid');

        return $this
            ->commandBus
            ->execute(new DeleteUser($uid))
            ->then(function () {
                return new JsonResponse('User will be deleted', 202);
            });
    }
}
