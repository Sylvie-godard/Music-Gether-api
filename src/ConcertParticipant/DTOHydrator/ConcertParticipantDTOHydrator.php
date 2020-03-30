<?php

declare(strict_types=1);

namespace App\ConcertParticipant\DTOHydrator;

use App\ConcertParticipant\DTO\ConcertParticipantDTO;

class ConcertParticipantDTOHydrator
{
    private $fields = ['user_id', 'concert_id'];

    public function extract(ConcertParticipantDTO $concertDTO)
    {
        $result = [];

        foreach ($this->fields as $field) {
            switch ($field) {
                case 'user_id':
                    $result['user_id'] = $concertDTO->getUserId();
                    break;
                case 'concert_id':
                    $result['concert_id'] = $concertDTO->getConcertId();
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
