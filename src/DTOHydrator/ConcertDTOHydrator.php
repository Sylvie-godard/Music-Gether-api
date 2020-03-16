<?php

declare(strict_types=1);

namespace App\DTOHydrator;

use App\DTO\ConcertDTO;

class ConcertDTOHydrator
{
    private $fields = ['id', 'artist', 'addresss', 'date', 'price'];

    public function extract(ConcertDTO $concertDTO)
    {
        $results = [];

        foreach ($this->fields as $field) {
            switch ($field) {
                case 'id':
                    $results['id'] = $concertDTO->getId();
                    break;
                case 'artist':
                    $results['artist'] = $concertDTO->getArtist();
                    break;
                case 'date':
                    $results['date'] = $concertDTO->getDate();
                    break;
                case 'price':
                    $results['price'] = $concertDTO->getPrice();
            }
        }
    }
}
