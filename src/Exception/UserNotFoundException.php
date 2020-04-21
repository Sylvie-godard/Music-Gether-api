<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class UserNotFoundException extends HttpException
{
    public function __construct(string $message = null)
    {
        parent::__construct( Response::HTTP_NOT_FOUND, $message, null, [], 0);
        $this->message = $message;
    }

    public static function fromEmail(string $email)
    {
        return new static(\sprintf('User not found for email %s', $email ));
    }

    public static function fromId(int $id)
    {
        return new static(\sprintf('User not found for id %s', $id));
    }
}
