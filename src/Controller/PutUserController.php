<?php

namespace App\Controller;

use App\Controller\Transformer\UserTransformer;
use Domain\Command\PutUser;
use Domain\Model\User\User;
use Drift\CommandBus\Bus\CommandBus;
use React\Promise\PromiseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class PutUserController
{

    /** @var CommandBus */
    private $commandBus;

    /**
     * PutUserController constructor.
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): PromiseInterface
    {
        $content = $request->getContent();
        $body = json_decode($content, true);
        $body['uid'] = $request->get('uid');

        $user = UserTransformer::fromArray($body);
        $command = new PutUser($user);

        return $this
            ->commandBus
            ->execute($command)
            ->then(function () {
                return new JsonResponse('User will be saved', 202);
            })
            ->otherwise(function (Throwable $t) {
                return new JsonResponse('Error saving user', 500);
            });
    }
}
