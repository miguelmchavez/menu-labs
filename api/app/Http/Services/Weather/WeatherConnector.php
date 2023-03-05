<?php

namespace App\Http\Services\Weather;

interface WeatherConnector
{
    public function request(string $lat, string $lng): Weather;

    public function handleData($data): Weather;
}