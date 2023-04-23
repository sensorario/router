<?php

#[Attribute]
class Route
{
    public function __construct(
        private string $method = 'GET',
        private string $path = '/',
    ) { }
}

class Response
{
    public function __construct(private array $json = []) { }

    public function getContent()
    {
        return json_encode(
            array_merge(
                $this->json,
                [
                    '@link' => [
                        'http://localhost:8888/',
                        'http://localhost:8888/info',
                        'http://localhost:8888/conclusioni',
                    ]
                ]
            )
        );
    }
}

interface Handler {
    public function handle(): Response;
}

#[Route('GET', '/')]
class HomeContoller implements Handler
{
    public function handle(): Response
    {
        return new Response([
            'page' => 'home'
        ]);
    }
}

#[Route('GET', '/info')]
class InfoController implements Handler
{
    public function handle(): Response
    {
        return new Response([
            'page' => 'info'
        ]);
    }
}

#[Route('GET', '/conclusioni')]
class ConclusionController implements Handler
{
    public function handle(): Response
    {
        return new Response([
            'message' => 'se questo video ti è piaciuto metti un like',
            'e' => 'iscriviti al canale per non perderti i prossimi video',
        ]);
    }
}

$routes = [
    HomeContoller::class,
    InfoController::class,
    ConclusionController::class,
];

function router(array $routes): Response {
    foreach($routes as $handler) {
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
}

$response = router($routes);

echo $response->getContent();