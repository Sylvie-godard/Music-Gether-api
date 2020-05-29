<?php

declare(strict_types=1);

namespace App\Concert\Validator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ConcertParticipantInput
{
    /**
     * @Assert\NotBlank
     *
     * @var int|null
     */
    private ?int $userId;

    /**
     * @Assert\NotBlank
     *
     * @var int|null
     */
    private ?int $concertId;

    public function __construct(?int $userId = null, ?int $concertId = null)
    {
        $this->userId = $userId;
        $this->concertId = $concertId;
    }

    public static function fromSymfonyRequest(Request $request)
    {
        $response = $request->request->all();

        $userId = isset($response['user_id']) ? (int) $response['user_id'] : null;
        $concertId = isset($response['concert_id']) ? (int) $response['concert_id'] : null;

        return new self($userId, $concertId);
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getConcertId(): int
    {
        return $this->concertId;
    }
}
