<?php

declare(strict_types=1);

namespace App\Concert\Service;

use App\Concert\DTO\ConcertDTO;
use App\Concert\Entity\Concert;
use App\Concert\Repository\ConcertRepository;

class ConcertService
{
    private $concertRepository;

    public function __construct(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
    }

    /**
     * @param Concert[]|array $concerts
     * @return array|ConcertDTO[]
     */
    public function getConcertsDTOFromConcerts(array $concerts): array
    {
        $concertsDTO = [];
        foreach ($concerts as $concert) {
            $concertsDTO[] = new ConcertDTO($concert);
        }

        return $concertsDTO;
    }

    public function getAll(): array
    {
        return $this->concertRepository->findAll();
    }

    public function save(Concert $concert): void
    {
        $this->concertRepository->save($concert);
    }
}
