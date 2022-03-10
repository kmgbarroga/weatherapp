@extends('layouts.app')

@section('customcss')
<style>

</style>
@endsection

@section('content')
<div class="container">
    {{-- justify-content-center --}}
    <div class="row mb-5">
        <div class="col-md-5 mb-2">
            <div class="card shadow-0 border mb-2 h-100">
                <div class="card-body p-4 text-center">

                    <h4 class="mb-1 sfw-normal">{{ $cityWeatherInfo->name }}, {{ $cityWeatherInfo->sys->country }}</h4>
                    <p>As of: <strong>{{ date("F j, Y, g:i a",$cityWeatherInfo->dt) }}</strong> </p>
                    <img class="" src=" http://openweathermap.org/img/wn/{{ $cityWeatherInfo->weather[0]->icon }}@2x.png" alt="Weather Icon">
                    <h5>Temperature: <strong>  {{ $cityWeatherInfo->main->temp }} °C </strong></h5>
                    <p> <strong>Feels like: {{ $cityWeatherInfo->main->feels_like }}°C. {{ $cityWeatherInfo->weather[0]->main }}</strong></p>
                    <p>Min: <strong>{{ $cityWeatherInfo->main->temp_min }}°C</strong>, Max: <strong>{{ $cityWeatherInfo->main->temp_max }}°C</strong></p>

                </div>
            </div>
        </div>
        <div class="col-md-7 mb-2">
            <div class="card shadow-0 border mb-2 h-100">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12 mb-2 text-center">
                            <ul style="list-style-type: none;">
                                <li>
                                    Pressure: {{ $cityWeatherInfo->main->pressure }} hPa <i class="fa-solid fa-gauge-high"></i>
                                </li>
                                <li>
                                    Humidity: {{ $cityWeatherInfo->main->humidity }} % <i class="fa-solid fa-droplet"></i>
                                </li>
                                <li>
                                    Visibility: {{ ($cityWeatherInfo->visibility/1000) }} km <i class="fa-solid fa-eye"></i>
                                </li>
                                <li>
                                    Wind Speed: {{ $cityWeatherInfo->wind->speed }} <i class="fa-solid fa-wind"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 text-center mb-2">
                            <i class="bi bi-sunrise" style="font-size:50px;"></i>
                            <p>Sunrise: <strong>{{ date("F j, Y, g:i a",$cityWeatherInfo->sys->sunrise) }}</strong></p>
                        </div>
                        <div class="col-lg-6 text-center mb-2">
                            <i class="bi bi-sunset" style="font-size:50px;"></i>
                            <p>Sunset: <strong>{{ date("F j, Y, g:i a",$cityWeatherInfo->sys->sunset) }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h5 class="text-center mb-5">Weather Forecast</h5>
    <div class="row" id="forecast-container">
        @foreach ($forecasts->list as $currForecast)
            <div class="col-md-3">
                <div class="card shadow-0 border mb-2">
                    <div class="card-body p-4 text-center">
                        <p>Date: <strong>{{ date("F j, Y, g:i A",$currForecast->dt) }}</strong> </p>
                        <img class="" src=" http://openweathermap.org/img/wn/{{ $currForecast->weather[0]->icon }}@2x.png" alt="Weather Icon">
                        <h5>Temperature: <strong>  {{ $currForecast->main->temp }} °C </strong></h5>
                        <p> <strong>Feels like: {{ $currForecast->main->feels_like }}°C. {{ $currForecast->weather[0]->main }}</strong></p>
                        <p>Min: <strong>{{ $currForecast->main->temp_min }}°C</strong>, Max: <strong>{{ $currForecast->main->temp_max }}°C</strong></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


</div>
@endsection

@section('customjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
    </script>
@endsection
