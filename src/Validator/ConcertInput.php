<?php

declare(strict_types=1);

namespace App\Validator;

use Cake\Chronos\Chronos;
use Cake\Chronos\ChronosInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ConcertInput
{
    /**
     * @Assert\NotBlank
     */
    private ?string $artist;

    /**
     * @Assert\NotBlank
     */
    private ?ChronosInterface $date;

    /**
     * @Assert\NotBlank
     */
    private ?string $address;

    /**
     * @Assert\NotBlank
     */
    private ?int $price;

    private function __construct(
        ?string $artist = null,
        ?ChronosInterface $date = null,
        ?string $address = null,
        ?int $price = null
    ){
        $this->artist = $artist;
        $this->date = $date;
        $this->address = $address;
        $this->price = $price;
    }

    public static function fromSymfonyRequest(Request $request): self
     {
        $response = $request->request->all();
        $artist = isset($response['artist']) ? $response['artist'] : null;
         $date = isset($response['date']) ? $response['date'] : null;
        $address = isset($response['address']) ? $response['address'] : null;
        $price = isset($response['price']) ? $response['price'] : null; // FIXME: what happens if the str price is not a number-str?

        if ($date !== null) {
            $date = Chronos::createFromFormat('m/d/Y', $response['date']);
        }

        return new static($artist, $date, $address, (int) $price);
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
}
