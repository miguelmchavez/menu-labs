<?php

namespace App\Http\Services\Weather;

abstract class WeatherRequester
{
    public string $lat;

    public string $lng;

    abstract public function getWeatherNetwork(): WeatherConnector;

    public function setPosition(string $lat, string $lng): void
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public function getWeather(): string
    {
        $weather = $this->getWeatherNetwork();

        return $weather->request($this->lat, $this->lng);
    }
}