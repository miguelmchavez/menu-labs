<?php

namespace App\Http\Services\Weather;

interface WeatherConnector
{
    public function request(string $lat, string $lng): string;
}