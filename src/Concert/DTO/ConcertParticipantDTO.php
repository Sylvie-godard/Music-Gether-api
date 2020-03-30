<?php

declare(strict_types=1);

namespace App\Concert\DTO;

use App\Concert\Entity\ConcertParticipant;

class ConcertParticipantDTO
{
    private $userId;

    private $concertId;

    public function __construct(ConcertParticipant $concertParticipant)
    {
        $this->userId = $concertParticipant->userId();
        $this->concertId = $concertParticipant->concertId();
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getConcertId(): int
    {
        return $this->concertId;
    }
}
