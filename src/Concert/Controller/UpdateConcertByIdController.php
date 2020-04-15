<?php

declare(strict_types=1);

namespace App\Concert\Controller;

use App\Concert\DTO\ConcertDTO;
use App\Concert\DTOHydrator\ConcertDTOHydrator;
use App\Concert\Service\ConcertService;
use App\Concert\Validator\UpdateConcertInput;
use App\Exception\InvalidDataException;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateConcertByIdController
{
    private ConcertService $concertService;

    private ValidatorInterface $validator;

    public function __construct(ConcertService $concertService, ValidatorInterface $validator)
    {
        $this->concertService = $concertService;
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

        $data = UpdateConcertInput::fromSymfonyRequestData($response);
        $errors = $this->validator->validate($data);

        if (\count($errors) > 0) {
            throw InvalidDataException::fromConstraintViolations($errors);
        }

        $concert = $this->concertService->getById($id);
        $this->concertService->update($concert, $response);

        $data = new ConcertDTOHydrator();
        $data = $data->extract(new ConcertDTO($concert));

        return new JsonResponse(['data' => $data]);
    }
}
