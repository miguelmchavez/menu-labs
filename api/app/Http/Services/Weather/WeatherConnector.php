<?php

namespace App\Http\Services\Weather;

use Illuminate\Http\Client\Response;

interface WeatherConnector
{
    public function request(string $lat, string $lng): Response;
}