<?php

declare(strict_types=1);

namespace App\Exception;

final class UserNotFoundException extends \Exception
{
    public static function fromEmail(string $email)
    {
        return new static(\sprintf('User not found for email %s', $email ));
    }
}
