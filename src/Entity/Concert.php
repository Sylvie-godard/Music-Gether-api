<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Cake\Chronos\Chronos;
use Doctrine\ORM\Mapping as ORM;
use Cake\Chronos\ChronosInterface;

/**
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
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    public function __construct(
        string $artist,
        ChronosInterface $date,
        string $address,
        int $price
    )
    {
        $this->artist = $artist;
        $this->date = $date;
        $this->address = $address;
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

    public function date(): ChronosInterface
    {
        return Chronos::createFromTimestamp($this->date->getTimestamp());
    }

    public function setDate(ChronosInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function address(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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
