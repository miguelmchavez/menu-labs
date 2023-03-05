<?php

namespace App\Http\Services\Weather;

use Exception;
use Illuminate\Http\Client\Response;

class OpenWeatherRequester extends WeatherRequester
{
    public function getWeatherNetwork(): WeatherConnector
    {
        return new OpenWeatherConnector();
    }

    public function processData(Response $response): Weather
    {
        if ($response->failed()) {
            $data = $response->json();
            \Log::info($data);

            throw new Exception('Something went wrong');
        }

        $data = $response->json();

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