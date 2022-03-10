<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\isEmpty;

class Weather {

    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config("app.openWeatherAppId");
    }

    public function fetchCityWeather($city){

        $information = [];
        $response = Http::get("api.openweathermap.org/data/2.5/weather",[
            'q'=>$city,
            'appid'=> $this->apiKey,
            'units'=>'metric'
        ]);
        $information['cityWeather'] = $response->body();

        return $information['cityWeather'];

    }

    public function fetchCityForecast($city){
        $response = Http::get("api.openweathermap.org/data/2.5/forecast",[
            'q'=>$city,
            'appid'=>$this->apiKey,
            'units'=>'metric',
            'cnt'=>5
        ]);
        $cityForecast = $response->body();

        return $cityForecast;
    }
}

