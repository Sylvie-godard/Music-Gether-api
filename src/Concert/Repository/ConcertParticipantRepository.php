<?php

declare(strict_types=1);

namespace App\Concert\Repository;

use App\Concert\Entity\Concert;
use App\Concert\Entity\ConcertParticipant;
use App\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;

class ConcertParticipantRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findById(int $id): ConcertParticipant
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('cp')
            ->from(ConcertParticipant::class, 'cp')
            ->where('cp.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByConcert(Concert $concert): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('cp')
            ->from(ConcertParticipant::class, 'cp')
            ->where('cp.concert = :concert')
            ->setParameter('concert', $concert)
            ->getQuery()
            ->getResult();
    }

    public function findByUser(User $user): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('cp')
            ->from(ConcertParticipant::class, 'cp')
            ->where('cp.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    public function findAll(): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('cp')
            ->from(ConcertParticipant::class, 'cp')
            ->getQuery()
            ->getResult();
    }

    public function save(ConcertParticipant $concertParticipant): void
    {
        $this->entityManager->persist($concertParticipant);
        $this->entityManager->flush();
    }
}
