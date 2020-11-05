<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request){
        $client = new Client();
        $token = $request->bearerToken();

        $response = $client->request('GET', 'http://localhost:5555/discussion', [
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);

        return [
            "response" => json_decode($response->getBody()),
        ];
    }

    public function show(Request $request, $id){
        $client = new Client();
        $token = $request->bearerToken();

        $response = $client->request('GET', "http://localhost:5555/discussion/$id", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);

        return [
            "response" => json_decode($response->getBody()),
        ];
    }
}
