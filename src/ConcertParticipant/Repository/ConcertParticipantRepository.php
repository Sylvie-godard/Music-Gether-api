<?php

declare(strict_types=1);

namespace App\ConcertParticipant\Repository;

use App\Concert\Entity\Concert;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;

class ConcertParticipantRepository
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $id
     * @return Concert
     * @throws NonUniqueResultException
     */
    public function findById(int $id): Concert
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('c')
            ->from(Concert::class, 'c')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAll(): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('c')
            ->from(Concert::class, 'c')
            ->getQuery()
            ->getResult();
    }

    public function save(Concert $concert): void
    {
        $this->entityManager->persist($concert);
        $this->entityManager->flush();
    }
}
