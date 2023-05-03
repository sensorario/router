<?php

namespace Sensorario\YoutubeAttributes;

interface Handler {
    public function handle(): Response;
}