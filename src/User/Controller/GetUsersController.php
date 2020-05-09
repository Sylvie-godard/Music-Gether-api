<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\User\DTO\UserDTO;
use App\User\DTOHydrator\UserDTOHydrator;
use App\User\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUsersController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(): JsonResponse
    {
        $users = $this->userService->getAll();
        $usersDTO = $this->userService->getUsersDTOFromUsers($users);
        $data = new UserDTOHydrator();
        $data = $data->extractCollection($usersDTO);

        return new JsonResponse(['data' => $data]);
    }
}
