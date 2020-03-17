<?php

declare(strict_types=1);

namespace App\User\Service;

use App\User\Entity\User;
use App\User\Repository\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(): array
    {
        return $this->userRepository->findAll();
    }

    public function save(User $user): void
    {
        $this->userRepository->save($user);
    }
}
