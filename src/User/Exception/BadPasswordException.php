<?php

declare(strict_types=1);

namespace User\Exception;

final class BadPasswordException extends \Exception
{
    public static function fromPassword()
    {
        return new static('User not provide good password');
    }
}
