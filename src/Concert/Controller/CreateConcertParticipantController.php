<?php

declare(strict_types=1);

namespace App\Concert\Controller;

use App\Concert\Entity\ConcertParticipant;
use App\Concert\Service\ConcertParticipantService;
use App\Concert\Service\ConcertService;
use App\Concert\Validator\ConcertParticipantInput;
use App\Exception\InvalidDataException;
use App\User\Service\UserService;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateConcertParticipantController
{
    private ConcertParticipantService $concertParticipantService;

    private ConcertService $concertService;

    private UserService $userService;

    private ValidatorInterface $validator;

    public function __construct(
        ConcertParticipantService $concertParticipantService,
        ValidatorInterface $validator,
        ConcertService $concertService,
        UserService $userService
    ) {
        $this->concertParticipantService = $concertParticipantService;
        $this->validator = $validator;
        $this->userService = $userService;
        $this->concertService = $concertService;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws InvalidDataException|NonUniqueResultException
     */
    public function __invoke(Request $request): Response
    {
        $concertInput = ConcertParticipantInput::fromSymfonyRequest($request);
        $errors = $this->validator->validate($concertInput);

        if (\count($errors) > 0) {
            throw InvalidDataException::fromConstraintViolations($errors);
        }

        $concert = $this->concertService->getById($concertInput->getConcertId());
        $user = $this->userService->getById($concertInput->getUserId());

        $this->concertParticipantService->create($concert, $user);

        return new Response(null, 201);
    }
}
