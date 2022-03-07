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

    public function fetchCityDetails($cityName){
        /**
         * OpenWeatherApi needs to get long and lat to
         * get city weather
         */
        $info = [];
        $cityDetails = Http::get("http://api.openweathermap.org/geo/1.0/direct",[
            'q'=>$cityName,
            'appid'=> $this->apiKey
        ]);

        // verify if api call is ok
        if($cityDetails->ok()){
            $cityDetails = json_decode($cityDetails->body());
            $info['lon'] = $cityDetails[0]->lon;
            $info['lat'] = $cityDetails[0]->lat;
        }

        return $info;
    }

    public function fetchCityWeather($info){
        $cityWeather = [];
        $response = Http::get("api.openweathermap.org/data/2.5/weather",[
            'lat'=>$info['lat'],
            'lon'=>$info['lon'],
            'appid'=> $this->apiKey
        ]);

        return json_decode($response->body());
    }

    public function getCityWeatherInfo($cityName){
        $cityDetails = $this->fetchCityDetails($cityName);
        $cityWeatherInfo = $this->fetchCityWeather($cityDetails);

        return $cityWeatherInfo;
    }
}

