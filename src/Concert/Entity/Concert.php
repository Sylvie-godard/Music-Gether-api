<?php

declare(strict_types=1);

namespace App\Concert\Entity;

use Cake\Chronos\Chronos;
use Cake\Chronos\ChronosInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Concert\Repository\ConcertRepository")
 */
class Concert
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $artist;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $address;

    /**
     * @ORM\Column(type="integer")
     */
    private int $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $photoUrl;

    public function __construct(
        string $artist,
        ChronosInterface $date,
        string $address,
        int $price,
        string $photoUrl
    ) {
        $this->artist = $artist;
        $this->date = $date;
        $this->address = $address;
        $this->price = $price;
        $this->photoUrl = $photoUrl;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function artist(): string
    {
        return $this->artist;
    }

    public function updateArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function date(): ChronosInterface
    {
        return Chronos::createFromTimestamp($this->date->getTimestamp());
    }

    public function updateDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function updateAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function updatePrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function photoUrl(): string
    {
        return $this->photoUrl;
    }

    public function updatePhotoUrl(string $photoUrl): void
    {
        $this->photoUrl = $photoUrl;
    }
}
