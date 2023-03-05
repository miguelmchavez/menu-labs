<?php

namespace App\Http\Services\Weather;

use App\Http\Services\Webservice;
use Illuminate\Http\Client\Response;

class WeatherApiConnector extends Webservice implements WeatherConnector
{
    protected string $lat;

    protected string $lng;

    public function getMethod(): string
    {
        return 'get';
    }

    public function getApiKey(): string
    {
        return config('weather.weather_api');
    }

    public function getEndpoint(): string
    {
        $key = $this->getApiKey();

        return "http://api.weatherapi.com/v1/current.json?key={$key}&q={$this->lat},{$this->lng}";
    }

    public function request(string $lat, string $lng): Response
    {
        $this->lat = $lat;
        $this->lng = $lng;

        $response = $this->makeRequest();

        return $response;
    }
}