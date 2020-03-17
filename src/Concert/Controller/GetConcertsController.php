<?php

declare(strict_types=1);

namespace App\Concert\Controller;

use App\Concert\DTO\ConcertDTO;
use App\Concert\DTOHydrator\ConcertDTOHydrator;
use App\Concert\Repository\ConcertRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetConcertsController
{
    private $concertRepository;

    public function __construct(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
    }

    public function __invoke(): JsonResponse
    {
        $concerts = $this->concertRepository->findAll();

        $concertsDTO = [];
        foreach ($concerts as $concert) {
            $concertsDTO[] = new ConcertDTO($concert);
        }

        $data = new ConcertDTOHydrator();
        $concerts = $data->extractCollection($concertsDTO);

        return new JsonResponse(['data' => $concerts]);
    }
}
