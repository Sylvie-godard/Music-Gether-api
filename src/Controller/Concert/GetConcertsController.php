<?php

declare(strict_types=1);

namespace App\Controller\Concert;

use App\DTO\ConcertDTO;
use App\DTOHydrator\ConcertDTOHydrator;
use App\Repository\ConcertRepository;
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
