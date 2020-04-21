<?php

declare(strict_types=1);

namespace App\User\Repository;

use App\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use App\Exception\UserNotFoundException;
use Doctrine\Persistence\ObjectRepository;
use UnexpectedValueException;

class UserRepository implements ObjectRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $id
     * @return User
     *
     * @throws NonUniqueResultException
     * @throws UserNotFoundException
     */
    public function findById(int $id): User
    {
        $user =  $this->entityManager
            ->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if ($user === null) {
            throw UserNotFoundException::fromId($id);
        }

        return $user;
    }

    /**
     * @param string $email
     * @return User
     *
     * @throws NonUniqueResultException
     * @throws UserNotFoundException
     */
    public function findByEmail(string $email): User
    {
        $user = $this->entityManager
            ->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();

        if ($user === null) {
            throw UserNotFoundException::fromEmail($email);
        }

        return $user;
    }

    public function findAll(): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->getQuery()
            ->getResult();
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * @inheritDoc
     */
    public function findBy(
        array $criteria,
        ?array $orderBy = null,
        $limit = null,
        $offset = null)
    {
        // TODO: Implement findBy() method.
    }

    /**
     * @inheritDoc
     * @throws NonUniqueResultException
     */
    public function findOneBy(array $criteria): User
    {
        $key = \array_key_first($criteria);
        $value = \array_shift($criteria);

        return $this->entityManager
            ->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where("u.$key = :$key")
            ->setParameter($key, $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @inheritDoc
     */
    public function getClassName()
    {
        // TODO: Implement getClassName() method.
    }
}
