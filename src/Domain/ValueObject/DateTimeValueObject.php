<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use DateTime;

class DateTimeValueObject
{
    public function __construct(private readonly string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}
