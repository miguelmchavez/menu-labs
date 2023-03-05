<?php

namespace App\Http\Services\Weather;

use App\Http\Services\Webservice;

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

    public function request(string $lat, string $lng): Weather
    {
        $this->lat = $lat;
        $this->lng = $lng;

        $res = $this->makeRequest();

        return $this->handleData($res);
    }

    public function handleData($data): Weather
    {
        $weather = new Weather();
        $weather->setDescription($data['current']['condition']['text']);
        $weather->setTemperature($data['current']['temp_c']);
        $weather->setFeelsLike($data['current']['feelslike_c']);
        // $weather->setMinTemperature($data['current']['temp_min']);
        // $weather->setMaxTemperature($data['current']['temp_max']);
        $weather->setPressure($data['current']['pressure_mb']);
        $weather->setHumidity($data['current']['humidity']);

        return $weather;
    }
}