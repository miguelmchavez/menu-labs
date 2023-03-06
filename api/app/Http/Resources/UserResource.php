<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $flag = false;
        $weather = null;
        if (request()->route('user')) {
            $flag = true;
            $weather = $this->getWeather();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'lat' => $this->latitude,
            'lng' => $this->longitude,
            'weather' => $this->when($flag, $weather),
        ];
    }
}
