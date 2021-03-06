<?php

declare(strict_types=1);

namespace App\Concert\Repository;

use App\Concert\Entity\Concert;
use App\Exception\ConcertNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;

class ConcertRepository
{
    private EntityManagerInterface $entityManager;

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

        $concert = $this->entityManager
            ->createQueryBuilder()
            ->select('c')
            ->from(Concert::class, 'c')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if ($concert === null) {
            throw ConcertNotFoundException::fromId($id);
        }

        return $concert;
    }

    public function findAll(?string $query = null): array
    {
        $qb = $this->entityManager
            ->createQueryBuilder()
            ->select('c')
            ->from(Concert::class, 'c');
        if ($query) {
            $qb->where('c.artist LIKE :artist')
                ->setParameter('artist', '%' . $query . '%');
        }

        return $qb->getQuery()->getResult();
    }

    public function save(Concert $concert): void
    {
        $this->entityManager->persist($concert);
        $this->entityManager->flush();
    }
}
