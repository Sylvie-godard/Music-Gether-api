<?php

declare(strict_types=1);

namespace App\Concert\Service;

use App\Concert\DTO\ConcertParticipantDTO;
use App\Concert\Entity\ConcertParticipant;
use App\Concert\Repository\ConcertParticipantRepository;

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
