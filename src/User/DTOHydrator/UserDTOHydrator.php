<?php

declare(strict_types=1);

namespace App\User\DTOHydrator;

use App\User\DTO\UserDTO;

class UserDTOHydrator
{
    private $fields = [
        'id',
        'name',
        'lastName',
        'age',
        'email',
        'genre',
        'admin',
        'photo_url',
    ];

    public function extract(UserDTO $userDTO)
    {
        $result = [];

        foreach ($this->fields as $field) {
            switch ($field) {
                case 'id':
                    $result['id'] = $userDTO->getId();
                    break;
                case 'name':
                    $result['name'] = $userDTO->getName();
                    break;
                case 'lastName':
                    $result['lastName'] = $userDTO->getLastName();
                    break;
                case 'age':
                    $result['age'] = $userDTO->getAge();
                    break;
                case 'email':
                    $result['email'] = $userDTO->getEmail();
                    break;
                case 'genre':
                    $result['genre'] = $userDTO->getGenre();
                    break;
                case 'photo_url':
                    $result['photo_url'] = $userDTO->getPhotoUrl();
            }
        }

        return $result;
    }

    /**
     * @param UserDTO[]|array $usersDTO
     * @return array
     */
    public function extractCollection(array $usersDTO)
    {
        $results = [];

        foreach ($usersDTO as $userDTO) {
            $results[] = $this->extract($userDTO);
        }

        return $results;
    }
}
