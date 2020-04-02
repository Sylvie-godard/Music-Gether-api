<?php

declare(strict_types=1);

namespace App\Concert\Validator;

use Cake\Chronos\Chronos;
use Cake\Chronos\ChronosInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final class ConcertInput
{
    /**
     * @Assert\NotBlank
     */
    private $artist;

    /**
     * @Assert\NotBlank
     */
    private $date;

    /**
     * @Assert\NotBlank
     */
    private $address;

    /**
     * @Assert\NotBlank
     */
    private $price;

    /**
     * @Assert\NotBlank
     */
    private $photoUrl;

    private function __construct(
        ?string $artist = null,
        ?ChronosInterface $date = null,
        ?string $address = null,
        ?int $price = null,
        ?string $photoUrl = null
    ) {
        $this->artist = $artist;
        $this->date = $date;
        $this->address = $address;
        $this->price = $price;
        $this->photoUrl = $photoUrl;
    }

    public static function fromSymfonyRequest(Request $request)
    {
        $response = $request->request->all();
        $date = $response['date'] ??= null;
        $price = $response['price'] ??= null;

        if (null !== $date) {
            $date = Chronos::createFromFormat('m/d/Y', $response['date']);
        }

        if (null !== $price) {
            $price = (int) $price;
        }

        return new static(
            $response['artist'] ??= null,
            $date,
            $response['address'] ??= null,
            $price,
            $response['photo_url'] ??= null
        );
    }

    public function address(): string
    {
        return $this->address;
    }

    public function artist(): string
    {
        return $this->artist;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function date(): ChronosInterface
    {
        return $this->date;
    }

    public function photoUrl(): string
    {
        return $this->photoUrl;
    }
}
