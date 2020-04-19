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
    private UserService $userService;

    private ValidatorInterface $validator;

    public function __construct(UserService $userService, ValidatorInterface $validator)
    {
        $this->userService = $userService;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @param int     $id
     * @return JsonResponse
     * @throws NonUniqueResultException
     * @throws InvalidDataException
     */
    public function __invoke(Request $request, int $id): JsonResponse
    {
        $response = (array) \json_decode($request->getContent());

        $data = UpdateUserInput::fromSymfonyRequestData($response);
        $errors = $this->validator->validate($data);

        if (\count($errors) > 0) {
            throw InvalidDataException::fromConstraintViolations($errors);
        }

        $user = $this->userService->getById($id);
        $this->userService->update($user, $response);

        $data = new UserDTOHydrator();
        $data = $data->extract(new UserDTO($user));

        return new JsonResponse(['data' => $data]);
    }
}
