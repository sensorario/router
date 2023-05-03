<?php

namespace Sensorario\YoutubeAttributes\Controllers;

use Sensorario\YoutubeAttributes\Handler;
use Sensorario\YoutubeAttributes\Response;
use Sensorario\YoutubeAttributes\Route;

#[Route('GET', '/')]
class HomeController implements Handler
{
    public function handle(): Response
    {
        return new Response([
            'page' => 'home'
        ]);
    }
}