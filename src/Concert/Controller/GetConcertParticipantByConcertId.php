<?php

declare(strict_types=1);

namespace App\Concert\Controller;

use App\Concert\DTOHydrator\ConcertParticipantDTOHydrator;
use App\Concert\Service\ConcertParticipantService;
use App\Concert\Service\ConcertService;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetConcertParticipantByConcertId
{
    private ConcertParticipantService $concertParticipantService;

    private ConcertService $concertService;

    public function __construct(
        ConcertParticipantService $concertParticipantService,
        ConcertService $concertService
    ) {
        $this->concertParticipantService = $concertParticipantService;
        $this->concertService = $concertService;
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws NonUniqueResultException
     */
    public function __invoke(int $id): JsonResponse
    {
        $concert = $this->concertService->getById($id);
        $concertParticipants = $this->concertParticipantService->getByConcert($concert);

        $concertParticipantsDTO = $this->concertParticipantService
            ->getConcertParticipantsDTOFromConcertParticipants($concertParticipants);

        $data = new ConcertParticipantDTOHydrator();
        $data = $data->extractCollection($concertParticipantsDTO);

        return new JsonResponse(['data' => $data]);
    }
}
