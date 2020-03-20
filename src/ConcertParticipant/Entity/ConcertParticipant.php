<?php

namespace App\ConcertParticipant\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\ConcertParticipant\Repository\ConcertParticipantRepository")
 */
class ConcertParticipant
{
    /**
     * @ORM\Id @ORM\Column(type="integer", length=255)
     */
    private $userId;

    /**
     * @ORM\Id @ORM\Column(type="integer", length=255)
     */
    private $concertId;

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
