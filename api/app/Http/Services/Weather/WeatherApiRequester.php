<?php

namespace App\Http\Services\Weather;

use Exception;
use Illuminate\Http\Client\Response;

class WeatherApiRequester extends WeatherRequester
{
    public function getWeatherNetwork(): WeatherConnector
    {
        return new WeatherApiConnector();
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