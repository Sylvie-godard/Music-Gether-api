<?php

declare(strict_types=1);

namespace App\Concert\Controller;

use App\Concert\DTOHydrator\ConcertParticipantDTOHydrator;
use App\Concert\Service\ConcertParticipantService;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetConcertParticipantsController
{
    private ConcertParticipantService $concertParticipantService;

    public function __construct(ConcertParticipantService $concertParticipant)
    {
        $this->concertParticipantService = $concertParticipant;
    }

    public function __invoke(): JsonResponse
    {
        $concertParticipants = $this->concertParticipantService->getAll();

        $concertParticipantsDTO = $this->concertParticipantService->getConcertParticipantsDTOFromConcertParticipants(
            $concertParticipants
        );

        $data = new ConcertParticipantDTOHydrator();
        $data = $data->extractCollection($concertParticipantsDTO);

        return new JsonResponse(['data' => $data]);
    }
}
