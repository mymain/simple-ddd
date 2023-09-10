<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\DateTimeValueObject;
use App\Domain\ValueObject\IntValueObject;
use App\Domain\ValueObject\StringValueObject;
use JsonSerializable;

class Car implements JsonSerializable
{
    public function __construct(
        private readonly StringValueObject $registrationNumber,
        private readonly StringValueObject $mark,
        private readonly StringValueObject $model,
        private readonly ?IntValueObject $id = null,
        private readonly ?DateTimeValueObject $createdAt = null,
        private readonly ?DateTimeValueObject $updatedAt = null,
    ) {
    }

    public function id(): ?IntValueObject
    {
        return $this?->id;
    }

    public function registrationNumber(): StringValueObject
    {
        return $this->registrationNumber;
    }

    public function mark(): StringValueObject
    {
        return $this->mark;
    }

    public function model(): StringValueObject
    {
        return $this->model;
    }

    public function createdAt(): ?DateTimeValueObject
    {
        return $this?->createdAt;
    }

    public function updatedAt(): ?DateTimeValueObject
    {
        return $this?->updatedAt;
    }

    public static function fromDbRow(array $row): self
    {
        return new self(
            registrationNumber: new StringValueObject($row['registration_number']),
            mark: new StringValueObject($row['mark']),
            model: new StringValueObject($row['model']),
            id: new IntValueObject($row['id']),
            createdAt: new DateTimeValueObject($row['created_at']),
            updatedAt: new DateTimeValueObject($row['updated_at']),
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'registrationNumber' => $this->registrationNumber->value(),
            'mark' => $this->mark->value(),
            'model' => $this->model->value(),
            'id' => $this->id->value(),
            'createdAt' => $this->createdAt->value(),
            'updatedAt' => $this->updatedAt->value(),
        ];
    }
}
