<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class ConcertNotFoundException extends HttpException
{
    public function __construct(string $message = null)
    {
        parent::__construct( Response::HTTP_NOT_FOUND, $message, null, [], 0);
        $this->message = $message;
    }

    public static function fromId(int $id)
    {
        return new static(\sprintf('Concert not found for id %s', $id));
    }
}
