<?php

declare(strict_types=1);

namespace App\Persistence;

use App\Domain\Entity\Car;
use App\Domain\Repository\CarRepositoryInterface;
use Exception;
use PDO;

class CarRepository implements CarRepositoryInterface
{
    private PDO $db;
    public function __construct()
    {
        $this->db = new PDO($_ENV['DATABASE_DSN']);
    }

    public function getById(int $id): Car
    {
        $stm = $this->db->prepare(<<<SQL
            SELECT * FROM car WHERE id = :id
        SQL);

        $stm->execute([
            'id' => $id,
        ]);

        return Car::fromDbRow($stm->fetchAll(PDO::FETCH_ASSOC));
    }

    public function delete(int $id): bool
    {
        try {
            $this->db->beginTransaction();

            $stm = $this->db->prepare(<<<SQL
                DELETE FROM car WHERE id = :id
            SQL);

            $stm->execute([
                "id" => $id
            ]);

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();

            throw $e;
        }

        return true;
    }

    public function save(Car $car): int
    {
        $this->db->beginTransaction();

        try {
            $stm = $this->db->prepare(<<<SQL
                INSERT INTO car 
                    (id, registration_number, mark, model, created_at, updated_at) 
                VALUES (null, ?, ?, ?, NOW(), NOW())
            SQL);

            $stm->execute([
                $car->registrationNumber()->value(),
                $car->mark()->value(),
                $car->model()->value(),
            ]);

            $id = (int) $this->db->lastInsertId();

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();

            throw $e;
        }

        return $id;
    }

    public function update(int $id, Car $car): bool
    {
        try {
            $this->db->beginTransaction();

            $stm = $this->db->prepare(<<<SQL
                UPDATE 
                    tasks 
                SET title=:title, 
                    description=:description,
                WHERE id = :id
            SQL);

            $stm->execute([
                "id" => $id,
                "title" => $car->getTitle()->getTitle(),
                "description" => $car->getDescription()->getDescription()
            ]);

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();

            throw $e;
        }

        return true;
    }

    public function getAll(): array
    {
        $stm = $this->db->prepare(<<<SQL
            SELECT * FROM car
        SQL);

        $stm->execute();

        $cars = [];

        foreach ($stm->fetchAll(PDO::FETCH_ASSOC) as $dbRow) {
            $cars[] = Car::fromDbRow($dbRow);
        }

        return $cars;
    }
}
