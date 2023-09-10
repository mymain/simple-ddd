<?php

declare(strict_types=1);

namespace App\Application;

class Response
{
    public function __construct(
        private readonly array $data,
    ) {
    }

    public function data(): array
    {
        return $this->data;
    }
}
