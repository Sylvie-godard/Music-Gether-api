<?php

declare(strict_types=1);

namespace App\Concert\Controller;

use App\Concert\DTO\ConcertDTO;
use App\Concert\DTOHydrator\ConcertDTOHydrator;
use App\Concert\Service\ConcertService;
use App\User\Service\UserService;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetConcertByIdController
{
    private ConcertService $concertService;

    private UserService $userService;

    public function __construct(ConcertService $concertService, UserService $userService)
    {
        $this->concertService = $concertService;
        $this->userService = $userService;
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws NonUniqueResultException
     */
    public function __invoke(int $id): JsonResponse
    {
        $concert = $this->concertService->getById($id);
        $concertParticipants = $concert->concertParticipants()->toArray();
        $users = $this->concertService->getUsersFromConcertParticipants($concertParticipants);

        $concertDTO = new ConcertDTO($concert);
        $concertDTO->setParticipants($this->userService->getUsersDTOFromUsers($users));
        $concertDTOHydrator = new ConcertDTOHydrator();
        $data = $concertDTOHydrator->extract($concertDTO);

        return new JsonResponse(['data' => $data]);
    }
}
