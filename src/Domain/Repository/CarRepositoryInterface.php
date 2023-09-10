<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Car;

interface CarRepositoryInterface
{
    public function getById(int $id): Car;

    public function save(Car $car): int;

    public function update(int $id, Car $car): bool;

    public function delete(int $id): bool;

    public function getAll(): array;
}
