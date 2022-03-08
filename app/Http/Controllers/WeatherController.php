<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\Weather;
use Illuminate\Support\Facades\Validator;

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

    public function requestCityWeather(Request $request){
        $validator = Validator::make($request->all(),['city'=>'required']);
        if(!$validator->fails()){
            $validatedData = $validator->validated();
        }else{
            return response()->json(['errors' => ['message' => ['The City Input is Invalid.']]], 422);
        }

        $cityWeather = new Weather();
        $cityDetails = $cityWeather->fetchCityDetails($validatedData['city']);
        $cityWeatherInfo = $cityWeather->getCityWeatherInfo($validatedData['city']);

        if($cityWeatherInfo == 422){
            return response()->json(['errors' => ['message' => ['The City Input is Invalid.']]], 422);
        }
        return json_encode($cityDetails);
    }
}
