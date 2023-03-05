<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Services\Weather\{
    WeatherRequester, 
    OpenWeatherRequester, 
    WeatherApiRequester
};
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getWeather()
    {
        // $weather = $this->clientWeather(new OpenWeatherRequester(), $this);
        $weather = $this->clientWeather(new WeatherApiRequester(), $this);

        return $weather;
    }

    protected function clientWeather(WeatherRequester $provider, User $user)
    {
        $weather = Cache::remember("user_weather_{$user->id}", 3600, function () use ($provider, $user) {
            $provider->setPosition($user->latitude, $user->longitude);
            return $provider->getWeather();
        });

        return $weather;
    }
}
