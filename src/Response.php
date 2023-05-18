<?php

namespace Sensorario\YoutubeAttributes;

class Response
{
    public function __construct(
        private string $response,
        private int $code = 200,
    ) { }

    public function getContent()
    {
        return $this->response;
    }
}