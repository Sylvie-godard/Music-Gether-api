<?php

declare(strict_types=1);

namespace App\Concert\Service;

use App\Concert\DTO\ConcertParticipantDTO;
use App\Concert\Entity\Concert;
use App\Concert\Entity\ConcertParticipant;
use App\Concert\Repository\ConcertParticipantRepository;
use App\User\Entity\User;

class ConcertParticipantService
{
    private ConcertParticipantRepository $concertParticipantRepository;

    public function __construct(ConcertParticipantRepository $concertParticipantRepository)
    {
        $this->concertParticipantRepository = $concertParticipantRepository;
    }

    public function create(Concert $concert, User $user): ConcertParticipant
    {
        $concertParticipant = new ConcertParticipant($concert, $user);
        $this->save($concertParticipant);

        return $concertParticipant;
    }

    public function getByConcert(Concert $concert): array
    {
        return $this->concertParticipantRepository->findByConcert($concert);
    }

    public function getById(int $id): ConcertParticipant
    {
        return $this->concertParticipantRepository->findById($id);
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
