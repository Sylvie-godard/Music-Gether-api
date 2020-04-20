<?php

declare(strict_types=1);

namespace App\User\DTO;

use App\User\Entity\User;

class UserDTO
{
    private int $id;

    private string $name;

    private string $lastName;

    private int $age;

    private string $genre;

    private string $email;

    private string $photoUrl;

    public function __construct(User $user)
    {
        $this->id = $user->id();
        $this->name = $user->name();
        $this->lastName = $user->lastName();
        $this->age = $user->age();
        $this->genre = $user->genre();
        $this->email = $user->getEmail();
        $this->photoUrl = $user->photoUrl();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhotoUrl(): ?string
    {
        return $this->photoUrl;
    }
}
