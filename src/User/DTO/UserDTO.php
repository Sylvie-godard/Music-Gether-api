<?php

declare(strict_types=1);

namespace App\User\DTO;

use App\User\Entity\User;

class UserDTO
{
    private $id;

    private $name;

    private $lastName;

    private $age;

    private $admin;

    private $genre;

    private $email;

    public function __construct(User $user)
    {
        $this->id = $user->id();
        $this->name = $user->name();
        $this->lastName = $user->lastName();
        $this->age = $user->age();
        $this->admin = $user->admin();
        $this->genre = $user->genre();
        $this->email = $user->email();
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

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
