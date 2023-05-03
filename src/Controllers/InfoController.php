<?php

namespace Sensorario\YoutubeAttributes\Controllers;

use Sensorario\YoutubeAttributes\Handler;
use Sensorario\YoutubeAttributes\Response;
use Sensorario\YoutubeAttributes\Route;

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