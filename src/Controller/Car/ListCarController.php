<?php

declare(strict_types=1);

namespace App\Controller\Car;

use App\Application\Request;
use App\Application\Response;
use App\Domain\Entity\Car;
use App\Domain\Repository\CarRepositoryInterface;
use App\Domain\ValueObject\StringValueObject;

class ListCarController
{
    public function __construct(
        private readonly Request $request,
        private readonly CarRepositoryInterface $carRepository,
    ) {
    }

    public function __invoke(): Response
    {
        $cars = $this->carRepository->getAll();

        return new Response($cars);
    }
}
