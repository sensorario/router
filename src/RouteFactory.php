<?php

namespace Sensorario\YoutubeAttributes;

use ReflectionAttribute;

class RouteFactory
{
    public function buildFromHttpRequest(): Route
    {
        return new Route(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
        );
    }

    public  function buildFromRflectionAttribute(ReflectionAttribute $reflectionAttribute): Route {
        return new Route(
            $reflectionAttribute->getArguments()[0],
            $reflectionAttribute->getArguments()[1],
        );
    }
}