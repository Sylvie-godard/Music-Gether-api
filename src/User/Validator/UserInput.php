<?php

declare(strict_types=1);

namespace App\User\Validator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final class UserInput
{
    /**
     * @Assert\NotBlank
     * @var string|null
     */
    private ?string $name;

    /**
     * @Assert\NotBlank
     * @var string|null
     */
    private ?string $lastName;

    /**
     * @Assert\NotBlank
     * @var string|null
     */
    private ?string $email;

    /**
     * @Assert\NotBlank
     * @var int|null
     */
    private ?int $age;

    /**
     * @Assert\NotBlank
     * @var string|null
     */
    private ?string $genre;

    /**
     * @var bool|null
     */
    private ?bool $admin;

    /**
     * @Assert\NotBlank
     * @var string|null
     */
    private ?string $password;

    /**
     * @var string|null
     */
    private ?string $photoUrl;

    private function __construct(
        ?string $name = null,
        ?string $lastName = null,
        ?int $age = null,
        ?string $genre = null,
        ?string $email = null,
        ?bool $admin = null,
        ?string $password = null,
        ?string $photoUrl = null
    ) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->genre = $genre;
        $this->email = $email;
        $this->admin = $admin;
        $this->password = $password;
        $this->photoUrl = $photoUrl;
    }

    public static function fromSymfonyRequest(Request $request)
    {
        $response = $request->request->all();

        $name = $response['name'] ??= null;
        $lastName = $response['lastName'] ??= null;
        $age = $response['age'] ??= null;
        $genre = $response['genre'] ??= null;
        $email = $response['email'] ??= null;
        $password = $response['password'] ??= null;
        $photoUrl = $response['photoUrl'] ??= null;

        if ($age !== null) {
            $age = (int) $age;
        }

        return new static(
            $name,
            $lastName,
            $age,
            $genre,
            $email,
            false,
            $password,
            $photoUrl
        );
    }

    public function name(): string
    {
        return $this->name;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function age(): int
    {
        return $this->age;
    }

    public function genre(): string
    {
        return $this->genre;
    }

    public function email(): string
    {
        return $this->email;
    }
}
