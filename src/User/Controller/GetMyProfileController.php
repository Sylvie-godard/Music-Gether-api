<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\User\DTO\UserDTO;
use App\User\DTOHydrator\UserDTOHydrator;
use App\User\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetMyProfileController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $user = $this->userService->getCurrentUser();

        $data = new UserDTOHydrator();

        $data = $data->extract(new UserDTO($user));

        return new JsonResponse(['data' => $data]);
    }
}
