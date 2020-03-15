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
    private $artist;

    /** 
     * @Assert\NotBlank
     */
    private $eventDate;

    /** 
     * @Assert\NotBlank
     */
    private $address;

    /** 
     * @Assert\NotBlank
     */
    private $price;

    private function __construct(
        ?string $artist = null, 
        ?ChronosInterface $eventDate = null, 
        ?string $address = null,
        ?int $price = null
    ){
        $this->artist = $artist;
        $this->eventDate = $eventDate;
        $this->address = $address;
        $this->price = $price;
    }

    public static function fromSymfonyRequest(Request $request)
     {
        $response = $request->request->all();
        $artist = isset($response['artist']) ? $response['artist'] : null;
        $eventDate = isset($response['date']) ? $response['date'] : null;
        $address = isset($response['address']) ? $response['address'] : null;
        $price = isset($response['price']) ? $response['price'] : null;

        if ($eventDate !== null) {
            $eventDate = Chronos::createFromFormat('m/d/Y', $response['date']);
        }

        return new static($artist, $eventDate, $address, $price);
     }
}
