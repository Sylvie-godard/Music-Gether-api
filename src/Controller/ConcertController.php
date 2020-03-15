<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Concert;
use App\Exception\InvalidDataException;
use App\Repository\ConcertRepository;
use App\Validator\ConcertInput;
use Cake\Chronos\Chronos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ConcertController
{
    private $validator;

    private $concertRepository;

    public function __construct(ValidatorInterface $validatorInterface, ConcertRepository $concertRepository)
    {
        $this->validator = $validatorInterface;
        $this->concertRepository = $concertRepository;
    }

    public function __invoke(Request $request): Response
    {
        $response = $request->request->all();

        $concertInput = ConcertInput::fromSymfonyRequest($request);
        $errors = $this->validator->validate($concertInput);

        if (\count($errors) > 0) {
            throw InvalidDataException::fromConstraintViolations($errors);
        }

        $date = Chronos::createFromFormat('m/d/Y', $response['date']);
        $concert = new Concert(
            $response['artist'], $date, $response['adress'], $response['price']
        );

        $this->concertRepository->save($concert);

        return new Response();
    }
}
