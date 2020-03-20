<?php

declare(strict_types=1);

namespace App\ConcertParticipant\Controller;

use App\ConcertParticipant\Entity\ConcertParticipant;
use App\ConcertParticipant\Service\ConcertParticipantService;
use App\ConcertParticipant\Validator\ConcertParticipantInput;
use App\Exception\InvalidDataException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateConcertParticipantController
{
    private $concertParticipantService;

    private $validator;

    public function __construct(ConcertParticipantService $concertParticipantService, ValidatorInterface $validator)
    {
        $this->concertParticipantService = $concertParticipantService;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $concertInput = ConcertParticipantInput::fromSymfonyRequest($request);
        $errors = $this->validator->validate($concertInput);

        if (\count($errors) > 0) {
            throw InvalidDataException::fromConstraintViolations($errors);
        }

        $concertParticipant = new ConcertParticipant($concertInput->getUserId(), $concertInput->getConcertId());

        $this->concertParticipantService->save($concertParticipant);

        return new Response(null, 201);
    }
}
