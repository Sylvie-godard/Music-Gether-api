<?php

declare(strict_types=1);

namespace App\Concert\DTOHydrator;

use App\Concert\DTO\ConcertParticipantDTO;
use App\User\DTOHydrator\UserDTOHydrator;

class ConcertParticipantDTOHydrator
{
    private array $fields = ['id', 'user', 'concert'];

    public function extract(ConcertParticipantDTO $concertDTO)
    {
        $result = [];
        $userDTOHydrator = new UserDTOHydrator();
        $concertDTOHydrator = new ConcertDTOHydrator();

        foreach ($this->fields as $field) {
            switch ($field) {
                case 'id':
                    $result['id'] = $concertDTO->getId();
                    break;
                case 'user':
                    $result['user'] = $userDTOHydrator->extract($concertDTO->getUser());
                    break;
                case 'concert':
                    $result['concert'] = $concertDTOHydrator->extract($concertDTO->getConcert());
                    break;
            }
        }

        return $result;
    }

    /**
     * @param ConcertParticipantDTO[]|array $concertParticipantsDTO
     * @return array
     */
    public function extractCollection(array $concertParticipantsDTO)
    {
        $results = [];

        foreach ($concertParticipantsDTO as $concertParticipantDTO) {
            $results[] = $this->extract($concertParticipantDTO);
        }

        return $results;
    }
}
