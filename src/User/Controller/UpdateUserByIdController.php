<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Exception\InvalidDataException;
use App\User\DTO\UserDTO;
use App\User\DTOHydrator\UserDTOHydrator;
use App\User\Service\UserService;
use App\User\Validator\UpdateUserInput;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateUserByIdController
{
    private $userService;

    private $validator;

    public function __construct(UserService $userService, ValidatorInterface $validator)
    {
        $this->userService = $userService;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws NonUniqueResultException
     */
    public function __invoke(Request $request, int $id): JsonResponse
    {
        $user = $this->userService->getById($id);

        $data = UpdateUserInput::fromSymfonyRequest($request);
        $errors = $this->validator->validate($data);

        if (\count($errors) > 0) {
            throw InvalidDataException::fromConstraintViolations($errors);
        }

        $this->userService->update($user);

        var_dump($user->lastName());
        die();
        $data = new UserDTOHydrator();
        $data = $data->extract(new UserDTO($user));

        return new JsonResponse(['data' => $data]);
    }
}
