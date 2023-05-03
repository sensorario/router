<?php

namespace Sensorario\YoutubeAttributes\Controllers;

use Sensorario\YoutubeAttributes\Handler;
use Sensorario\YoutubeAttributes\Response;
use Sensorario\YoutubeAttributes\Route;

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