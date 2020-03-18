<?php

declare(strict_types=1);

namespace App\User\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class UpdateUserInput
{
    /**
     * @Assert\Type("string")
     * @var string|null
     */
    private $name;

    /**
     * @Assert\Type("string")
     * @var string|null
     */
    private $lastName;

    /**
     * @Assert\Type("string")
     * @var string|null
     */
    private $email;

    /**
     * @Assert\Type("integer")
     * @var int|null
     */
    private $age;

    /**
     * @Assert\Type("string")
     * @var string|null
     */
    private $genre;

    /**
     * @Assert\Type("bool")
     * @var bool|null
     */
    private $admin;

    private function __construct(
        ?string $name = null,
        ?string $lastName = null,
        ?int $age = null,
        ?string $genre = null,
        ?string $email = null,
        ?bool $admin = null
    ) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->genre = $genre;
        $this->email = $email;
        $this->admin = $admin;
    }

    public static function fromSymfonyRequestData(array $response)
    {
        $name = isset($response['name']) ? $response['name'] : null;
        $lastName = isset($response['lastName']) ? $response['lastName'] : null;
        $age = isset($response['age']) ? $response['age'] : null;
        $genre = isset($response['genre']) ? $response['genre'] : null;
        $email = isset($response['email']) ? $response['email'] : null;
        $admin = isset($response['admin']) ? $response['admin'] : null;

        return new static($name, $lastName, (int) $age, $genre, $email, $admin);
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
