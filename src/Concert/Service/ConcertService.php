<?php

declare(strict_types=1);

namespace App\Concert\Service;

use App\Concert\Entity\Concert;
use App\Concert\Repository\ConcertRepository;

class ConcertService
{
    private $concertRepository;

    public function __construct(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
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
