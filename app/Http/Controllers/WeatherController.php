<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\Weather;

class WeatherController extends Controller
{

    public function index(){
        return view('weather.index');

    }

    public function requestCityForecast(Request $request){
        $validatedData = $request->validate([
            'city' => ['required'],
        ]);



    }

    // public function requestCityWeather(Request $request){
    //     $validatedData = $request->validate([
    //         'city' => ['required'],
    //     ]);

    //     $cityWeather = new Weather();
    //     $cityWeatherInfo = $cityWeather->getCityWeatherInfo($validatedData['city']);
    //     return json_encode($cityWeatherInfo);
    // }

    public function requestCityWeather($city="Tokyo"){
        // $validatedData = $request->validate([
        //     'city' => ['required'],
        // ]);

        $cityWeather = new Weather();
        $cityWeatherInfo = $cityWeather->getCityWeatherInfo($city);
        // echo "i got her with $city";
        return json_encode($cityWeatherInfo);
    }
}
