<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Cake\Chronos\ChronosInterface; 

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ConcertRepository")
 */
class Concert
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artist;

    /**
     * @ORM\Column(type="date")
     */
    private $eventDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eventLocation;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    public function __construct(
        string $artist, 
        ChronosInterface $eventDate, 
        string $eventLocation, 
        int $price
    ) {
        $this->artist = $artist;
        $this->eventDate = $eventDate;
        $this->eventLocation = $eventLocation;
        $this->price = $price;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function artist(): string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function eventDate(): ChronosInterface
    {
        return $this->eventDate;
    }

    public function setEventDate(\DateTimeInterface $eventDate): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function eventLocation(): ?string
    {
        return $this->eventLocation;
    }

    public function setEventLocation(string $eventLocation): self
    {
        $this->eventLocation = $eventLocation;

        return $this;
    }

    public function price(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
