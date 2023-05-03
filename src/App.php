<?php

namespace Sensorario\YoutubeAttributes;

class App
{
    public function __construct(private Router $router)
    {

    }

    public function run() {
        // $routes = require_once __DIR__ . '/../config/config.php';
        // $response = (new Router($routes))->match();
        $routes = require_once __DIR__ . '/../config/config.php';
        $response = $this->router->match();
        echo $response->getContent();
    }
}