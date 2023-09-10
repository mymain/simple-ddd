<?php

declare(strict_types=1);

namespace App\Application;

class Application
{
    public Router $router;

    public function __construct(
        private readonly Request $request,
    ) {
        $this->router = new Router($this->request);
    }

    public function run(): Response
    {
        return $this->router->resolve();
    }
}
