<?php

declare(strict_types=1);

namespace App\Concert\Controller;

use App\Concert\DTOHydrator\ConcertDTOHydrator;
use App\Concert\Service\ConcertService;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetConcertsController
{
    private $concertService;

    public function __construct(ConcertService $concertService)
    {
        $this->concertService = $concertService;
    }

    public function __invoke(): JsonResponse
    {
        $concerts = $this->concertService->getAll();

        $data = new ConcertDTOHydrator();
        $data = $data->extractCollection($this->concertService->getConcertsDTOFromConcerts($concerts));

        return new JsonResponse(['data' => $data]);
    }
}
