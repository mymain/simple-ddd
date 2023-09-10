<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Application\Application;
use App\Application\Request;
use App\Controller\Car\CreateCarController;
use App\Controller\Car\ListCarController;
use App\Controller\IndexController;
use App\Persistence\CarRepository;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');

$dotenv->load();
$request = new Request();
$app = new Application($request);

$app->router->set('/api/', new IndexController());
$app->router->set('/api/car/create', new CreateCarController($request, new CarRepository()));
$app->router->set('/api/car/list', new ListCarController($request, new CarRepository()));

$response = $app->run();

header('Content-Type: application/json');

echo json_encode($response->data());
