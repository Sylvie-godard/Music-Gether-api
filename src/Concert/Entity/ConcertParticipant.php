<?php

namespace App\Concert\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Concert\Repository\ConcertParticipantRepository")
 */
class ConcertParticipant
{
    /**
     * @ORM\Id @ORM\Column(type="integer", length=255)
     */
    private int $userId;

    /**
     * @ORM\Id @ORM\Column(type="integer", length=255)
     */
    private int $concertId;

    public function __construct(int $userId, int $concertId)
    {
        $this->userId = $userId;
        $this->concertId = $concertId;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function concertId(): int
    {
        return $this->concertId;
    }
}
