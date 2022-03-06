<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    private $openWeatherApiKey;

    public function __construct()
    {
        $this->openWeatherApiKey = $_ENV['OPEN_WEATHER_API'];
    }

    public function index(){
        return view('weather.index');

    }

    public function getOpenWeatherApiKey(){
        return $this->openWeatherApiKey;
    }

    public function requestCityForecast(Request $request){
        $validatedData = $request->validate([
            'city' => ['required'],
        ]);


        // /**
        //  * Get long and lat values using Openweather GEO API using City Name
        //  */
        // $response = Http::get("http://api.openweathermap.org/geo/1.0/direct",[
        //     'q'=>$cityName,
        //     'appid'=>$this->getOpenWeatherApiKey()
        // ]);
        // // $response = Http::get("https://api.openweathermap.org/geo/1.0/direct?q=Tokyo&appid=c9f2d456bc813a6a684963276e2d72fe");
        // print_r($response->body());
        // // return response()->json($response);
    }
}
