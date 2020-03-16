<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\Concert;

class ConcertDTO
{
    private $id;

    private $artist;

    private $date;

    private $address;

    private $price;

    public function __construct(Concert $concert)
    {
        $this->id = $concert->id();
        $this->artist = $concert->artist();
        $this->date = $concert->date()->toDateString();
        $this->address = $concert->address();
        $this->price = $concert->price();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getArtist(): string
    {
        return $this->artist;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
