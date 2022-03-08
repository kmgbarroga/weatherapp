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
                console.log('select city init')
                var cityVal = $("#cityField").val();
                $.ajax({
                    url:"{{ route('city.weather') }}",
                    method:"POST",
                    data:{
                        city:cityVal
                    },
                    success:function(dataresponse){
                        console.log(dataresponse)
                    },
                    error:function(errResponse){
                        var errors = $.parseJSON(errResponse.responseText.errors);
                        console.log(errors);
                        // var data = JSON.parse(errResponse);
                        // console.log(errResponse);
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
