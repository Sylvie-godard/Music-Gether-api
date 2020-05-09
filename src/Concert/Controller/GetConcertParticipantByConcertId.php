<?php

declare(strict_types=1);

namespace App\Concert\Controller;

use App\Concert\DTOHydrator\ConcertParticipantDTOHydrator;
use App\Concert\Service\ConcertParticipantService;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetConcertParticipantByConcertId
{
    private ConcertParticipantService $concertParticipantService;

    public function __construct(ConcertParticipantService $concertParticipantService)
    {
        $this->concertParticipantService = $concertParticipantService;
    }

    public function __invoke(int $id): JsonResponse
    {
        $concertParticipants = $this->concertParticipantService->getByConcertId($id);

        $concertParticipantsDTO = $this->concertParticipantService->getConcertParticipantsDTOFromConcertParticipants(
            $concertParticipants
        );

        $data = new ConcertParticipantDTOHydrator();
        $data = $data->extractCollection($concertParticipantsDTO);

        return new JsonResponse(['data' => $data]);
    }
}
