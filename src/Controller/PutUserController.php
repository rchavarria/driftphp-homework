<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use function React\Promise\resolve;

class PutUserController
{

    public function __invoke(Request $request)
    {
        $uid = $request->get('uid');

        return resolve(new JsonResponse([
            'uid' => $uid
        ], 200));
    }
}
