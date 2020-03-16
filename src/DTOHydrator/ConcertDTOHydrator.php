<?php

declare(strict_types=1);

namespace App\DTOHydrator;

use App\DTO\ConcertDTO;

class ConcertDTOHydrator
{
    private $fields = ['id', 'artist', 'addresss', 'date', 'price'];

    public function extract(ConcertDTO $concertDTO)
    {
        $result = [];

        foreach ($this->fields as $field) {
            switch ($field) {
                case 'id':
                    $result['id'] = $concertDTO->getId();
                    break;
                case 'artist':
                    $result['artist'] = $concertDTO->getArtist();
                    break;
                case 'date':
                    $result['date'] = $concertDTO->getDate();
                    break;
                case 'price':
                    $result['price'] = $concertDTO->getPrice();
                    break;
            }
        }

        return $result;
    }

    /**
     * @param ConcertDTO[]|array $concertsDTO
     * @return array
     */
    public function extractCollection(array $concertsDTO)
    {
        $results = [];

        foreach ($concertsDTO as $concertDTO) {
            $results[] = $this->extract($concertDTO);
        }

        return $results;
    }
}
