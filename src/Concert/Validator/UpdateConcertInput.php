<?php

declare(strict_types=1);

namespace App\Concert\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class UpdateConcertInput
{
    /**
     * @Assert\Type("string")
     * @var string|null
     */
    private $artist;

    /**
     * @Assert\Type("string")
     * @var string|null
     */
    private $date;

    /**
     * @Assert\Type("string")
     * @var string|null
     */
    private $address;

    /**
     * @Assert\Type("integer")
     * @var int|null
     */
    private $price;

    private function __construct(
        ?string $artist = null,
        ?string $date = null,
        ?int $address = null,
        ?int $price = null
    ) {
        $this->artist = $artist;
        $this->date = $date;
        $this->address = $address;
        $this->price = $price;
    }

    public static function fromSymfonyRequestData(array $response)
    {
        $artist = isset($response['artist']) ? $response['artist'] : null;
        $date = isset($response['date']) ? $response['date'] : null;
        $address = isset($response['address']) ? $response['address'] : null;
        $price = isset($response['price']) ? $response['price'] : null;

        return new static($artist, $date, $address, (int) $price);
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }
}
