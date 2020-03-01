<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConcertController
{
    public function __invoke(Request $request): Response
    {
        $response = $request->request->all();

        var_dump($response);
        return new Response();
    }
}