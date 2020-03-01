<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

class ConcertController
{

    public function __invoke(Request $request)
    {
        var_dump($request->request->all);
    }
}