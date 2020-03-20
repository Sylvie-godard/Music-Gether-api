<?php

declare(strict_types=1);

namespace App\ConcertParticipant\Controller;

use App\Concert\DTOHydrator\ConcertParticipantDTOHydrator;
use App\ConcertParticipant\Service\ConcertParticipantService;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetConcertParticipantsController
{
    private $concertParticipantService;

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
