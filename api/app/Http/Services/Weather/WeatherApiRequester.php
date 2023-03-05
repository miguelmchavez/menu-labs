<?php

namespace App\Http\Services\Weather;

class WeatherApiRequester extends WeatherRequester
{
    public function getWeatherNetwork(): WeatherConnector
    {
        return new WeatherApiConnector();
    }
}