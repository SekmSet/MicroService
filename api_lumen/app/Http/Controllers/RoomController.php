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

        $expressResult = json_decode($response->getBody());
        foreach($expressResult->messages as $key => $message){
            $idMessage = $message->id_messages;
            $slimMessage = $client->request('GET', "http://localhost:8080/messages/$idMessage", [
                'headers' => [
                    'Authorization' => "Bearer $token",
                ]
            ]);

            $text = json_decode($slimMessage->getBody());
            $expressResult->messages[$key]->detail = $text->data;
        }

        return [
            "response" => $expressResult,
        ];
    }

    public function create(Request $request) {
        $room = $request->get('room');
        $client = new Client();

        $token = $request->bearerToken();

        $response = $client->request('POST', 'http://localhost:5555/discussion', [
            'json' => [
                'room' => $room
            ],
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);

        return [
            "response" => json_decode($response->getBody()),
        ];
    }

    public function delete(Request $request, $id) {
        $client = new Client();

        $token = $request->bearerToken();

        $response = $client->request('DELETE', "http://localhost:5555/discussion/$id", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);

        return [
            "response" => json_decode($response->getBody()),
        ];
    }
}
