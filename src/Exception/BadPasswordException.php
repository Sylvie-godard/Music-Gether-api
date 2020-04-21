<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class BadPasswordException extends HttpException
{
    public function __construct(string $message = null)
    {
        parent::__construct( Response::HTTP_BAD_REQUEST, $message, null, [], 0);
        $this->message = $message;
    }

    public static function fromPassword()
    {
        return new static('User not provide good password');
    }
}
