<?php

namespace App\User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\User\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $lastName;

    /**
     * @ORM\Column(type="integer")
     */
    private int $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $genre;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $admin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $email;

    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    private ?string $photoUrl;

    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     *
     * @var string
     */
    private ?string $password;

    public function __construct(
        string $name,
        string $lastName,
        int $age,
        string $genre,
        string $email,
        bool $admin,
        ?string $password = null,
        ?string $photoUrl = null
    ) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->genre = $genre;
        $this->email = $email;
        $this->admin = $admin;
        $this->photoUrl = $photoUrl;
        $this->password = $password;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function updateName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function updateLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function age(): int
    {
        return $this->age;
    }

    public function updateAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function genre(): string
    {
        return $this->genre;
    }

    public function updateGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function admin(): bool
    {
        return $this->admin;
    }

    public function updateAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function updateEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function photoUrl(): ?string
    {
        return $this->photoUrl;
    }

    public function password(): ?string
    {
        return $this->password;
    }
}
