<?php

declare(strict_types=1);

namespace App\Concert\DTO;

use App\Concert\Entity\Concert;
use App\Concert\Entity\ConcertParticipant;
use App\User\DTO\UserDTO;
use App\User\Entity\User;

class ConcertParticipantDTO
{
    private int $id;

    private User $user;

    private Concert $concert;

    public function __construct(ConcertParticipant $concertParticipant)
    {
        $this->id = $concertParticipant->getId();
        $this->user = $concertParticipant->user();
        $this->concert = $concertParticipant->concert();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): UserDTO
    {
        return new UserDTO($this->user);
    }

    public function getConcert(): ConcertDTO
    {
        return new ConcertDTO($this->concert);
    }
}
