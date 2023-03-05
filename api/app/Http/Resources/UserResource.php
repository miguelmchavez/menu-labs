<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public bool $flag;

    public function __construct($resource, bool $flag)
    {
        $this->resource = $resource;
        $this->flag = $flag;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $weather = false;
        if ($this->flag) {
            $weather = $this->getWeather();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'lat' => $this->latitude,
            'lng' => $this->longitude,
            'weather' => $this->when($this->flag, $weather),
        ];
    }
}
