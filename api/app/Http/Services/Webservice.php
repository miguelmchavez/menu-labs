<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\{Response, RequestException};

abstract class Webservice
{
    abstract protected function getMethod(): string;

    abstract protected function getEndpoint(): string;

    public function makeRequest(): Response
    {
        $method = $this->getMethod();
        $endpoint = $this->getEndpoint();

        try {
            $response = Http::$method($endpoint)->throw();
        } catch (RequestException $exception) {
            $response = $exception->response;
        }

        return $response;
    }
}