<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class IntValueObject
{
    public function __construct(protected readonly int $value)
    {
    }

    public function value(): int
    {
        return $this->value;
    }
}
