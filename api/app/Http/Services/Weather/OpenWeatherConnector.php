<?php

namespace App\Http\Services\Weather;

use App\Http\Services\Webservice;

class OpenWeatherConnector extends Webservice implements WeatherConnector
{
    protected string $lat;

    protected string $lng;

    public function getMethod(): string
    {
        return 'get';
    }

    public function getApiKey(): string
    {
        return config('weather.open_weather');
    }

    public function getEndpoint(): string
    {
        $key = $this->getApiKey();

        return "https://api.openweathermap.org/data/2.5/weather?lat={$this->lat}&lon={$this->lng}&appid={$key}";
    }

    public function request(string $lat, string $lng): string
    {
        $this->lat = $lat;
        $this->lng = $lng;

        $res = $this->makeRequest();
        \Log::info($res);
        return "current";
    }
}