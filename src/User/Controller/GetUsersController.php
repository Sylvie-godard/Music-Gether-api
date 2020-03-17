<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\User\DTO\UserDTO;
use App\User\DTOHydrator\UserDTOHydrator;
use App\User\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUsersController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(): JsonResponse
    {
        $users = $this->userRepository->findAll();

        $usersDTO = [];
        foreach ($users as $user) {
            $usersDTO[] = new UserDTO($user);
        }

        $data = new UserDTOHydrator();
        $data = $data->extractCollection($usersDTO);

        return new JsonResponse(['data' => $data]);
    }
}
