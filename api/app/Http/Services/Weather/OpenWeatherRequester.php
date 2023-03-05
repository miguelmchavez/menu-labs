<?php

namespace App\Http\Services\Weather;

class OpenWeatherRequester extends WeatherRequester
{
    public function getWeatherNetwork(): WeatherConnector
    {
        return new OpenWeatherConnector();
    }
}