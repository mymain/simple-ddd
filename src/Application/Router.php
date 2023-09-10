<?php

declare(strict_types=1);

namespace App\Application;

class Router
{
    public function __construct(
        private readonly Request $request,
        private array $routes = [],
    ) {
    }

    public function set(string $route, object $controller): void
    {
        $this->routes[$route] = $controller;
    }
    public function resolve(): Response
    {
        return $this->routes[
            $this->request->getRequestUri()
        ]->__invoke();
    }
}
