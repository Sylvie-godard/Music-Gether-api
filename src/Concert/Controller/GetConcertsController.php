<?php

declare(strict_types=1);

namespace App\Concert\Controller;

use App\Concert\DTOHydrator\ConcertDTOHydrator;
use App\Concert\Service\ConcertService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetConcertsController
{
    private ConcertService $concertService;

    public function __construct(
        ConcertService $concertService
    ) {
        $this->concertService = $concertService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $query = $request->query->get('artist', null);
        $concerts = $this->concertService->getAll($query);

        $data = new ConcertDTOHydrator();
        $data = $data->extractCollection($this->concertService->getConcertsDTOFromConcerts($concerts));

        return new JsonResponse(['data' => $data]);
    }
}
