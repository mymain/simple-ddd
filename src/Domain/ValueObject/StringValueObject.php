<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class StringValueObject
{
    public function __construct(protected readonly string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}
