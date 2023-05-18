<?php

namespace Sensorario\YoutubeAttributes\Tests;

use Attribute;
use PHPUnit\Framework\TestCase;
use Sensorario\YoutubeAttributes\Handler;
use Sensorario\YoutubeAttributes\Response;
use Sensorario\YoutubeAttributes\Route;
use Sensorario\YoutubeAttributes\RouteFactory;
use Sensorario\YoutubeAttributes\Router;

class RouterTest extends TestCase
{
    /** @test */
    public function shouldThrowAnExceptionWheneverConfigurationIsNotValid()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Oops! Missing controllers in configuration file.');

        $router = new Router([]);
        $router->match();
    }

    /** @test */
    public function shouldThrowAnExceptionWheneverControllersDoesNotMatchWithHttpRequest()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Oops! Something went wrong.');

        $router = new Router([
            'controllers' => [],
        ]);
        $router->match();
    }

    /** @test */
    public function shouldThrowAnExceptionWheneverHandlerClassIsNotPresentInRouteConfiguratioin()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Oops! Missing handler class in controller configuration');

        $router = new Router([
            'controllers' => [
                null,
            ],
        ]);

        $router->match();
    }

    /** @test */
    public function shouldThrowAnExceptionWheneverAttributeRouteIsMissingInControllerClass()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Oops! Missing #[Route] in Controller class');

        $router = new Router([
            'controllers' => [
                ControllerWithoutAttributes::class,
            ],
        ]);

        $router->match();
    }

    /** @test */
    public function shouldThrowAnExceptionWheneverControllerIsNotAnHandlerInstance()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Oops! Controller should be an instance of Sensorario\YoutubeAttributes\Handler class.');

        /** @var RouteFactory */
        $factory = $this->getMockBuilder(RouteFactory::class)
            ->getMock();

        $router = new Router([
            'controllers' => [
                ControllerWithAttributes::class,
            ],
        ], $factory);

        $router->match();
    }
}

class ControllerWithoutAttributes implements Handler
{
    public function handle(): Response
    {
        return new Response(json_encode([
            'success' => 'true',
        ]));
    }
}

#[Route]
class ControllerWithAttributes
{

}

#[Route]
class ValidControllerClass implements Handler
{
    public function handle(): Response
    {
        return new Response(json_encode([
            'success' => 'true',
        ]));
    }
}