<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\User\DTO\UserDTO;
use App\User\DTOHydrator\UserDTOHydrator;
use App\User\Service\UserService;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetUserByIdController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws NonUniqueResultException
     */
    public function __invoke(Request $request, int $id): JsonResponse
    {
        $user = $this->userService->getById($id);

        $data = new UserDTOHydrator();

        $data = $data->extract(new UserDTO($user));

        return new JsonResponse(['data' => $data]);
    }
}
