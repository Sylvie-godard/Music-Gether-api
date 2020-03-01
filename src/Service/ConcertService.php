<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Concert;
use App\Repository\ConcertRepository;

class ConcertService
{
    private $concertRepository;

    public function __construct(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
    }

    public function save(Concert $concert): void
    {
        $this->concertRepository->save($concert);
    }
}
