<?php

namespace App\Http\Services\Weather;

class Weather
{
    public $description;

    public $temperature;

    public $feelsLike;

    public $minTemperature;

    public $maxTemperature;

    public $pressure;

    public $humidity;

    public function setDescription($desc)
    {
        $this->description = $desc;
    }

    public function setTemperature($temp)
    {
        $this->temperature = $temp;
    }

    public function setFeelsLike($feel)
    {
        $this->feelsLike = $feel;
    }

    public function setMinTemperature($min)
    {
        $this->minTemperature = $min;
    }

    public function setMaxTemperature($max)
    {
        $this->maxTemperature = $max;
    }

    public function setPressure($pressure)
    {
        $this->pressure = $pressure;
    }

    public function setHumidity($humidity)
    {
        $this->humidity = $humidity;
    }
}