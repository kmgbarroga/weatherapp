<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\Weather;
use Illuminate\Support\Facades\Validator;

class WeatherController extends Controller
{

    public function index(){
        $cityWeather = new Weather();
        /**
         * Display weather for the possible cities that foreign
         * tourist will visit
         */
        $cities = ['Tokyo','Yokohama','Kyoto','Osaka','Nagoya'];
        $citiesWeather = [];
        foreach($cities as $currCity){
            // fetch weather info for each city
            $citiesWeather[$currCity] = json_decode($cityWeather->fetchCityWeather($currCity));
        }

        return view('weather.index',[
            'citiesWeather'=>$citiesWeather
        ]);

    }

    public function requestCityForecastAndPlaces(Request $request){
        $validatedData = $request->validate([
            'city' => ['required'],
        ]);

    }

    public function requestCityWeather(Request $request){
        $validator = Validator::make($request->all(),['city'=>'required']);
        if(!$validator->fails()){
            $validatedData = $validator->validated();
        }else{
            return response()->json(['errors' => ['message' => ['The City Input is Empty.']]], 422);
        }

        $cityWeather = new Weather();
        $cityWeatherInfo = $cityWeather->fetchCityWeather($validatedData['city']);
        return response()->json($cityWeatherInfo);
    }
}
