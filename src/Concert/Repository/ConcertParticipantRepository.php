<?php

declare(strict_types=1);

namespace App\Concert\Repository;

use App\Concert\Entity\Concert;
use App\Concert\Entity\ConcertParticipant;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;

class ConcertParticipantRepository
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findByConcertId(int $concertId): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('cp')
            ->from(ConcertParticipant::class, 'cp')
            ->where('cp.concertId = :concertId')
            ->setParameter('concertId', $concertId)
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
