<?php

declare(strict_types=1);

namespace App\Application;

class Request
{
    public function getRequestUri(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '/';
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getPost(string $key): string
    {
        return trim($_POST[$key]);
    }
}
