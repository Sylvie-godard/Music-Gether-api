<?php

declare(strict_types=1);

namespace App\Concert\DTOHydrator;

use App\Concert\DTO\ConcertDTO;

class ConcertDTOHydrator
{
    private array $fields = ['id', 'artist', 'address', 'date', 'price', 'photo_url'];

    public function extract(ConcertDTO $concertDTO): array
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
                case 'address':
                    $result['address'] = $concertDTO->getAddress();
                    break;
                case 'date':
                    $result['date'] = $concertDTO->getDate();
                    break;
                case 'price':
                    $result['price'] = $concertDTO->getPrice();
                    break;
                case 'photo_url':
                    $result['photo_url'] = $concertDTO->getPhotoUrl();
                    break;
            }
        }

        return $result;
    }

    /**
     * @param ConcertDTO[]|array $concertsDTO
     * @return array
     */
    public function extractCollection(array $concertsDTO): array
    {
        $results = [];

        foreach ($concertsDTO as $concertDTO) {
            $results[] = $this->extract($concertDTO);
        }

        return $results;
    }
}
