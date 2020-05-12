<?php

declare(strict_types=1);

namespace App\Concert\Service;

use App\Concert\DTO\ConcertDTO;
use App\Concert\Entity\Concert;
use App\Concert\Repository\ConcertRepository;
use Cake\Chronos\Chronos;
use Doctrine\ORM\NonUniqueResultException;

class ConcertService
{
    private ConcertRepository $concertRepository;

    public function __construct(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
    }

    /**
     * @param Concert[]|array $concerts
     * @return array|ConcertDTO[]
     */
    public function getConcertsDTOFromConcerts(array $concerts): array
    {
        $concertsDTO = [];
        foreach ($concerts as $concert) {
            $concertsDTO[] = new ConcertDTO($concert);
        }

        return $concertsDTO;
    }

    public function update(Concert $concert, array $fields): Concert
    {
        foreach ($fields as $key => $value) {
            switch ($key) {
                case 'artist':
                    $concert->updateArtist($value);
                    break;
                case 'address':
                    $concert->updateAddress($value);
                    break;
                case 'date':
                    $date = \DateTime::createFromFormat('m/d/Y', $value);
                    $concert->updateDate($date);
                    break;
                case 'price':
                    $concert->updatePrice($value);
                    break;
            }
        }

        $this->save($concert);

        return $concert;
    }

    /**
     * @param int $id
     * @return Concert
     * @throws NonUniqueResultException
     */
    public function getById(int $id): Concert
    {
        return $this->concertRepository->findById($id);
    }

    public function getAll(?string $query = null): array
    {
        return $this->concertRepository->findAll($query);
    }

    public function save(Concert $concert): void
    {
        $this->concertRepository->save($concert);
    }

    public function getUsersFromConcertParticipants(array $concertParticipants): array
    {
        return \array_map(fn($n) => $n->user(), $concertParticipants);
    }
}
