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

        // $response = $client->request('GET', 'https://api.foursquare.com/v3/places/nearby?ll=35.4478%2C35.4478&query=Osaka&limit=1', [
        //     'headers' => [
        //         'Accept: */*',
        //         'User-Agent: curl/7.68.0',
        //         'Accept-Encoding: deflate,gzip,br',
        //         'Accept' => 'application/json',
        //         'Authorization' => 'fsq3CfosemM5EnlRXe9adXjlZ2RdTks+kVcEpFrAmvUTjlQ=',
        // ],
        // ]);
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

