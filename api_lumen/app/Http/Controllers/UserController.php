<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
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

        $response = $client->request('GET', 'http://localhost:8080/users', [
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

        $response = $client->request('GET', "http://localhost:8080/users/$id", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);

        return [
            "response" => json_decode($response->getBody()),
        ];
    }
}
