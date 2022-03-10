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
        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => $this->apiKey
        ])->get("https://api.foursquare.com/v3/places/nearby",[
            'query'=>$params['city'],
            'limit'=>5,
            'll'=>$params['lonlat']
        ]);

        return $response->body();
    }


}

