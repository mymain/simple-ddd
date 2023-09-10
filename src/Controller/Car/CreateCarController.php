<?php

declare(strict_types=1);

namespace App\Controller\Car;

use App\Application\Request;
use App\Application\Response;
use App\Domain\Entity\Car;
use App\Domain\Repository\CarRepositoryInterface;
use App\Domain\ValueObject\StringValueObject;

class CreateCarController
{
    public function __construct(
        private readonly Request $request,
        private readonly CarRepositoryInterface $carRepository,
    ) {
    }

    public function __invoke(): Response
    {
        //move to service
        $car = new Car(
            registrationNumber: new StringValueObject($this->request->getPost('registrationNumber')),
            mark: new StringValueObject($this->request->getPost('mark')),
            model: new StringValueObject($this->request->getPost('model')),
        );

        return new Response(['id' => $this->carRepository->save($car)]);
    }
}
