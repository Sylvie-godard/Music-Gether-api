<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Concert;
use Doctrine\ORM\EntityManagerInterface;

class ConcertRepository
{
    private EntityManagerInterface $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Concert $concert): void
    {
        $this->entityManager->persist($concert);
        $this->entityManager->flush($concert); // FIXME: flush does not have parameter
    }
}
