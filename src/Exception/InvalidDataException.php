<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class InvalidDataException extends \Exception
{
    public static function fromConstraintViolations(ConstraintViolationListInterface $violationList)
    {
        $messages = [];
        foreach ($violationList as $violation) {
            $messages = $violation->getMessage();
        }

        return new static($messages);
    }
}
