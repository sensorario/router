<?php

namespace Sensorario\YoutubeAttributes;

class Response
{
    public function __construct(private array $json = []) { }

    public function getContent()
    {
        $port = 9999;
        return json_encode(
            array_merge(
                $this->json,
                [
                    '@link' => [
                        'http://localhost:'.$port.'/',
                        'http://localhost:'.$port.'/info',
                        'http://localhost:'.$port.'/conclusioni',
                    ]
                ]
            )
        );
    }
}