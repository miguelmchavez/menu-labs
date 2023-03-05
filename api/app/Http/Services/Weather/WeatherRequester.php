<?php

namespace App\Http\Services\Weather;

use Illuminate\Http\Client\Response;

abstract class WeatherRequester
{
    public string $lat;

    public string $lng;

    abstract public function getWeatherNetwork(): WeatherConnector;

    abstract public function processData(Response $response): Weather;

    public function setPosition(string $lat, string $lng): void
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public function getWeather(): Weather
    {
        $weather = $this->getWeatherNetwork();

        $response = $weather->request($this->lat, $this->lng);

        return $this->processData($response);
    }
}