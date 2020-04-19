<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\User\Service\UserService;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exception\BadPasswordException;
use App\Exception\UserNotFoundException;

class AuthUserLoginController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws NonUniqueResultException
     * @throws UserNotFoundException
     * @throws BadPasswordException
     */
    public function __invoke(Request $request): Response
    {
        $email = $request->query->get('email', null);
        $password = $request->query->get('password', null);

        if ($password !== null && $email !== null) {
            $user = $this->userService->getByEmail($email);

            if ($user->password() !== $password) {
                throw BadPasswordException::fromPassword();
            }

            return new Response(null, 201);
        }

        return new Response(null, 401);
    }
}
