<?php

declare(strict_types=1);

namespace App\User\Service;

use App\User\DTO\UserDTO;
use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use App\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserService
{
    private UserRepository $userRepository;

    private TokenStorageInterface $tokenStorage;

    public function __construct(UserRepository $userRepository, TokenStorageInterface $tokenStorage)
    {
        $this->userRepository = $userRepository;
        $this->tokenStorage = $tokenStorage;
    }

    public function getCurrentUser()
    {
        $token = $this->tokenStorage->getToken();
        if ($token instanceof TokenInterface) {
            /** @var User $user */
            $user = $token->getUser();

            return $user;
        }

        return null;
    }

    /**
     * @param int $id
     * @return User
     *
     * @throws NonUniqueResultException
     */
    public function getById(int $id): User
    {
        return $this->userRepository->findById($id);
    }

    public function getAll(): array
    {
        return $this->userRepository->findAll();
    }

    /**
     * @param string $email
     * @return User
     * @throws NonUniqueResultException
     * @throws UserNotFoundException
     */
    public function getByEmail(string $email): User
    {
        return $this->userRepository->findByEmail($email);
    }

    /**
     * @param array|User[] $users
     * @return array
     */
    public function getUsersDTOFromUsers(array $users): array
    {
        $usersDTO = [];
        foreach ($users as $user) {
            $usersDTO[] = new UserDTO($user);
        }

        return $usersDTO;
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
                    $user->updateAge($value);
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
