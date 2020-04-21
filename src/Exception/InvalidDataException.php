<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class InvalidDataException extends HttpException
{
    public function __construct(string $message = null)
    {
        parent::__construct( Response::HTTP_BAD_REQUEST, $message, null, [], 0);
        $this->message = $message;
    }

    public static function fromConstraintViolations(ConstraintViolationListInterface $violationList)
    {
        $messages = [];
        foreach ($violationList as $violation) {
            $messages = $violation->getMessage();
        }

        return new static(\implode(', ', $messages));
    }
}
