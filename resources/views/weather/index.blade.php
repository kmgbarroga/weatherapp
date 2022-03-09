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
                    <div class="card-body p-4">

                        <h4 class="mb-1 sfw-normal">{{ $currCityWeather->name }}, {{ $currCityWeather->sys->country }}</h4>
                        <p class="mb-2">Current temperature: <strong>{{ $currCityWeather->main->temp }} °C</strong></p>
                        <p>Feels like: <strong>{{ $currCityWeather->main->feels_like }}°C</strong></p>
                        <p>Max: <strong>6.11°C</strong>, Min: <strong>3.89°C</strong></p>

                        <div class="d-flex flex-row align-items-center">
                            <p class="mb-0 me-4">Scattered Clouds</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty

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
