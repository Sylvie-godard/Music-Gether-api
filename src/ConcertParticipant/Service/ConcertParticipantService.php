<?php

declare(strict_types=1);

namespace App\ConcertParticipant\Service;

use App\ConcertParticipant\DTO\ConcertParticipantDTO;
use App\ConcertParticipant\Entity\ConcertParticipant;
use App\ConcertParticipant\Repository\ConcertParticipantRepository;

class ConcertParticipantService
{
    private $concertParticipantRepository;

    public function __construct(ConcertParticipantRepository $concertParticipantRepository)
    {
        $this->concertParticipantRepository = $concertParticipantRepository;
    }

    public function getByConcertId(int $concertId): array
    {
        return $this->concertParticipantRepository->findByConcertId($concertId);
    }

    public function getConcertParticipantsDTOFromConcertParticipants(array $concertParticipants): array
    {
        $concertParticipantsDTO = [];
        foreach ($concertParticipants as $concertParticipant) {
            $concertParticipantsDTO[] = new ConcertParticipantDTO($concertParticipant);
        }

        return $concertParticipantsDTO;
    }

    public function getAll(): array
    {
        return $this->concertParticipantRepository->findAll();
    }

    public function save(ConcertParticipant $concertParticipant): void
    {
        $this->concertParticipantRepository->save($concertParticipant);
    }
}
