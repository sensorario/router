<?php

namespace Sensorario\YoutubeAttributes;

use ReflectionClass;

class Router
{
    public function __construct(private array $config) { }

    public function match(): Response
    {
        foreach($this->config['controllers'] as $handler) {
            $reflection = new ReflectionClass($handler);
            $attributes = $reflection->getAttributes(Route::class);
            foreach($attributes as $attribute) {
                if ($attribute->getArguments()[0] === $_SERVER['REQUEST_METHOD']) {
                    if ($attribute->getArguments()[1] === $_SERVER['REQUEST_URI']) {
                        return (new $handler)->handle();
                    }
                }
            }
        }

        throw new \RuntimeException('Oops! Something went wrong.');
    }
}