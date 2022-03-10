@extends('layouts.app')

@section('customcss')
<style>

</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Select City..." id="cityField">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="btnSelectCity">
                        <i class="fa fa-arrow-circle-right"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div class="row" id="cities-weather-container">
        @forelse ($citiesWeather as $currCityWeather)

            <div class="col-md-4">
                <div class="card shadow-0 border mb-2">
                    <div class="card-body p-4 text-center">

                        <h4 class="mb-1 sfw-normal">{{ $currCityWeather->name }}, {{ $currCityWeather->sys->country }}</h4>
                        <p>As of: <strong>{{ date("F j, Y, g:i a",$currCityWeather->dt) }}</strong> </p>
                        <img class="" src=" http://openweathermap.org/img/wn/{{ $currCityWeather->weather[0]->icon }}@2x.png" alt="Weather Icon">
                        <h5>Temperature: <strong>  {{ $currCityWeather->main->temp }} °C </strong></h5>
                        <p> <strong>Feels like: {{ $currCityWeather->main->feels_like }}°C. {{ $currCityWeather->weather[0]->main }}</strong></p>
                        <p>Min: <strong>{{ $currCityWeather->main->temp_min }}°C</strong>, Max: <strong>{{ $currCityWeather->main->temp_max }}°C</strong></p>
                        <a href="{{ route('city.forecast.places',['city'=>$currCityWeather->name]) }}" class="btn btn-secondary"> <i class="fa fa-cloud-sun-rain"></i> <i class="fa fa-city"></i> View Forecast and Popular Places</a>
                    </div>
                </div>
            </div>
        @empty
            <h5>Unfortunately, No Records were Found.</h5>
        @endforelse


    </div>


</div>
@endsection

@section('customjs')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function getCityWeather() {
                var cityVal = $("#cityField").val();
                $.ajax({
                    dataType: "json",
                    url:"{{ route('city.weather') }}",
                    method:"POST",
                    data:{
                        city:cityVal
                    },
                    success:function(dataresponse){
                        console.log(dataresponse)
                    },
                    error:function(errResponse){
                        var errorObj = errResponse.responseJSON;
                        console.log(errorObj);
                        console.log(errorObj['errors']['message']);
                    }
                });
            }
            $('#cityField').on('keypress',function(e){
                if(e.which == 13){
                    getCityWeather();
                }
            });
            $('#btnSelectCity').on('click',function(){
                getCityWeather();
            })

        })
    </script>
@endsection
