<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\InvalidDataException;
use App\Validator\ConcertInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ConcertController
{
    private $validator;

    public function __construct(ValidatorInterface $validatorInterface)
    {
        $this->validator = $validatorInterface;
    }

    public function __invoke(Request $request): Response
    {
        $response = $request->request->all();

        $concertInput = ConcertInput::fromSymfonyRequest($request);
        $errors = $this->validator->validate($concertInput);

        if (\count($errors) > 0) {
            throw InvalidDataException::fromConstraintViolations($errors);
        }


        return new Response();
    }
}
