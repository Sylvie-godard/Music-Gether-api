<?php

declare(strict_types=1);

namespace App\Concert\Repository;

use App\Concert\Entity\Concert;
use Doctrine\ORM\EntityManagerInterface;

class ConcertRepository
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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
