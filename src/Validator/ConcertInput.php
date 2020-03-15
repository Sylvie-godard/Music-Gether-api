<?php

declare(strict_types=1);

namespace App\Validator;

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
    private $adress;

    /** 
     * @Assert\NotBlank
     */
    private $price;

    private function __construct(
        ?string $artist = null, 
        ?ChronosInterface $eventDate = null, 
        ?string $adress = null, 
        ?int $price = null
    ){
        $this->artist = $artist;
        $this->eventDate = $eventDate;
        $this->adress = $adress;
        $this->price = $price;
    }

    public static function fromSymfonyRequest(Request $request)
     {
        $response = $request->request->all();
        $artist = isset($response['artist']) ? $response['artist'] : null;
        $eventDate = isset($response['date']) ? $response['date'] : null;
        $adress = isset($response['adress']) ? $response['adress'] : null;
        $price = isset($response['price']) ? $response['price'] : null;

        return new static($artist, $eventDate, $adress, $price);
     }
}
