<?php

declare(strict_types=1);

namespace App\Concert\DTO;

use App\Concert\Entity\Concert;

class ConcertDTO
{
    private int $id;

    private string $artist;

    private string $date;

    private string $address;

    private int $price;

    private string $photoUrl;

    public function __construct(Concert $concert)
    {
        $this->id = $concert->id();
        $this->artist = $concert->artist();
        $this->date = $concert->date()->toDayDateTimeString();
        $this->address = $concert->address();
        $this->price = $concert->price();
        $this->photoUrl = $concert->photoUrl();
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

    public function getPhotoUrl(): string
    {
        return $this->photoUrl;
    }
}
