<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

class Places {

    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config("app.fourSquareApi");
    }

    public function getNearbyPlaces($params){
        $client = new \GuzzleHttp\Client();

        // $response = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Authorization' => $this->apiKey
        // ])->get("https://api.foursquare.com/v3/places/search?near",[
        //     'query'=>$params['city'],
        //     'limit'=>5,
        //     'll'=>$params['lonlat']
        // ]);
        $string_query = "https://api.foursquare.com/v3/places/search?near=".$params['city']."&limit=5";

        $response = $client->request('GET', $string_query, [
            'headers' => [
                'Authorization' => 'fsq3t+ZaiTtvYUa1v8YOHwsra3FHm6nBHCo7R4uRkxIT9+Y=',
                'accept' => 'application/json',
            ],
        ]);


        return $response->getBody();
    }


}

