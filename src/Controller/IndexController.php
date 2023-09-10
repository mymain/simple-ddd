<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\Response;

class IndexController
{
    public function __invoke(): Response
    {
        return new Response([1, 2, 3]);
    }
}
