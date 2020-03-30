<?php

declare(strict_types=1);

namespace App\Concert\Controller;

use App\Concert\Entity\Concert;
use App\Concert\Service\ConcertService;
use App\Concert\Validator\ConcertInput;
use App\Exception\InvalidDataException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateConcertController
{
    private ValidatorInterface $validator;

    private ConcertService $concertService;

    public function __construct(ValidatorInterface $validatorInterface, ConcertService $concertService)
    {
        $this->validator = $validatorInterface;
        $this->concertService = $concertService;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws InvalidDataException
     */
    public function __invoke(Request $request): Response
    {
        $concertInput = ConcertInput::fromSymfonyRequest($request);
        $errors = $this->validator->validate($concertInput);

        if (\count($errors) > 0) {
            throw InvalidDataException::fromConstraintViolations($errors);
        }

        $concert = new Concert(
            $concertInput->artist(), $concertInput->date(), $concertInput->address(), $concertInput->price()
        );

        $this->concertService->save($concert);

        return new Response(null, 201);
    }
}
