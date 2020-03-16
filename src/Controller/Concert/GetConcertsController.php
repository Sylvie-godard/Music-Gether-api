<?php

declare(strict_types=1);

namespace App\Controller\Concert;

use App\Repository\ConcertRepository;
use Symfony\Component\HttpFoundation\Response;

class GetConcertsController
{
    private $concertRepository;

    public function __construct(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
    }

    public function __invoke(): Response
    {
        $concerts = $this->concertRepository->findAll();

        var_dump($results);die();
        return new Response(null, 201);
    }
}
