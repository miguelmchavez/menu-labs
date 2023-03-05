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

        return "https://api.openweathermap.org/data/2.5/weather?lat={$this->lat}&lon={$this->lng}&appid={$key}&units=metric";
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
        $weather->setDescription($data['weather'][0]['main']);
        $weather->setTemperature($data['main']['temp']);
        $weather->setFeelsLike($data['main']['feels_like']);
        $weather->setMinTemperature($data['main']['temp_min']);
        $weather->setMaxTemperature($data['main']['temp_max']);
        $weather->setPressure($data['main']['pressure']);
        $weather->setHumidity($data['main']['humidity']);

        return $weather;
    }
}