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

    /**
     * @param int $id
     * @return User
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getById(int $id)
    {
        return $this->userRepository->findById($id);
    }

    public function getAll(): array
    {
        return $this->userRepository->findAll();
    }

    public function update(User $user, array $fields): User
    {
        foreach ($fields as $key => $value) {
            switch ($key) {
                case 'name':
                    $user->updateName($value);
                    break;
                case 'lastName':
                    $user->updateLastName($value);
                    break;
                case 'email':
                    $user->updateEmail($value);
                    break;
                case 'genre':
                    $user->updateGenre($value);
                    break;
                case 'age':
                    $user->updateGenre($value);
                    break;
            }
        }

        $this->save($user);

        return $user;
    }

    public function save(User $user): void
    {
        $this->userRepository->save($user);
    }
}
