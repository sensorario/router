<?php

use Sensorario\YoutubeAttributes\Router;

require __DIR__ . '/../vendor/autoload.php';

$config = require  __DIR__ . '/../config/config.php';

$router = new Router($config);

$response = $router->match();

echo $response->getContent();