<?php

namespace Sensorario\YoutubeAttributes;

use ReflectionClass;
use Sensorario\YoutubeAttributes\Handler;

class Router
{
    public function __construct(
        private array $config,
        private RouteFactory $factory = new RouteFactory,
    ) { }

    public function match(): Response
    {
        if (!isset($this->config['controllers'])) {
            throw new \RuntimeException('Oops! Missing controllers in configuration file.');
        }
        
        foreach($this->config['controllers'] as $handler) {
            if (!class_exists($handler)) {
                throw new \RuntimeException('Oops! Missing handler class in controller configuration');
            }

            if (!method_exists($handler, 'handle')) {
                throw new \RuntimeException(
                    sprintf('Oops! Controller should be an instance of '. Handler::class .' class.')
                );
            }

            $reflection = new ReflectionClass($handler);
            $attributes = $reflection->getAttributes(Route::class);

            if ($attributes === []) {
                throw new \RuntimeException('Oops! Missing #[Route] in Controller class');
            }

            foreach($attributes as $attribute) {
                $requestRoute = $this->factory->buildFromHttpRequest();
                $controllerRoute = $this->factory->buildFromRflectionAttribute($attribute);
                if ($requestRoute == $controllerRoute) {
                    return (new $handler)->handle();
                }
            }
        }

        throw new \RuntimeException('Oops! Something went wrong.');
    }
}