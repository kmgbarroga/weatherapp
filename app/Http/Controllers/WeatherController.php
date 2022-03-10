<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\Weather;
use App\Services\Places;
use function PHPUnit\Framework\isEmpty;
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

    public function requestCityForecastAndPlaces($city){

        if(!empty($city)){
            $params = [];
            $cityWeather = new Weather();
            $placesObj = new Places();
            $cityWeatherInfo = json_decode($cityWeather->fetchCityWeather($city));
            if( empty($cityWeatherInfo) ){
                return abort('404');
            }
            $params['city'] = $city;
            $params['lonlat'] = $cityWeatherInfo->coord->lat .",".$cityWeatherInfo->coord->lat;

            $forecasts = json_decode($cityWeather->fetchCityForecast($city));
            $places = json_decode($placesObj->getNearbyPlaces($params));
            return view('weather.forecast',[
                'cityWeatherInfo'=>$cityWeatherInfo,
                'forecasts'=>$forecasts,
                'places'=>$places
            ]);
        }

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

        if( isEmpty(json_decode($cityWeatherInfo)) ){
            return response()->json(['errors' => ['message' => ['No Data Found for City.']]], 422);
        }
        return response()->json($cityWeatherInfo);
    }
}
