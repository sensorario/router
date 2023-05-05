<?php

namespace Sensorario\YoutubeAttributes;

use Attribute;
use ReflectionAttribute;

#[Attribute]
class Route
{
    public function __construct(
        private string $method = 'GET',
        private string $path = '/',
    ) { }
}