<?php

namespace App\Concert\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\User\Entity\User;

/**
 * @ORM\Entity(repositoryClass="App\Concert\Repository\ConcertParticipantRepository")
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="concert_participant", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="user_concert_unique", columns={"user_id", "concert_id"})
 * }
)
 */
class ConcertParticipant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="concertParticipant")
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity=Concert::class, inversedBy="participations")
     */
    private Concert $concert;

    public function __construct(Concert $concert, User $user)
    {
        $this->concert = $concert;
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Concert
     */
    public function concert(): Concert
    {
        return $this->concert;
    }

    /**
     * @param Concert $concert
     */
    public function setConcert(Concert $concert): void
    {
        $this->concert = $concert;
    }
}
