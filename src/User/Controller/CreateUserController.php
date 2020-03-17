<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Exception\InvalidDataException;
use App\User\Entity\User;
use App\User\Repository\UserRepository;
use App\User\Service\UserService;
use App\User\Validator\UserInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserController
{
    private $validator;

    private $userService;

    public function __construct(ValidatorInterface $validatorInterface, UserService $userService)
    {
        $this->validator = $validatorInterface;
        $this->userService = $userService;
    }

    public function __invoke(Request $request): Response
    {
        $userInput = UserInput::fromSymfonyRequest($request);
        $errors = $this->validator->validate($userInput);

        if (\count($errors) > 0) {
            throw InvalidDataException::fromConstraintViolations($errors);
        }

        $user = new User(
            $userInput->name(),
            $userInput->lastName(),
            $userInput->age(),
            $userInput->genre(),
            $userInput->email(),
            false
        );

        $this->userService->save($user);

        return new Response(null, 201);
    }
}