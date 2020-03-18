<?php

declare(strict_types=1);

namespace App\Concert\Controller;

use App\Concert\DTO\ConcertDTO;
use App\Concert\DTOHydrator\ConcertDTOHydrator;
use App\Concert\Service\ConcertService;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetConcertByIdController
{
    private $concertService;

    public function __construct(ConcertService $concertService)
    {
        $this->concertService = $concertService;
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws NonUniqueResultException
     */
    public function __invoke(int $id): JsonResponse
    {
        $concert = $this->concertService->getById($id);

        $data = new ConcertDTOHydrator();
        $data = $data->extract(new ConcertDTO($concert));

        return new JsonResponse(['data' => $data]);
    }
}
