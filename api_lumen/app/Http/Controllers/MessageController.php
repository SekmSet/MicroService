<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MessageController extends Controller
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

    public function create(Request $request, $idRoom) {
        $client = new Client();
        $token = $request->bearerToken();

        $id_senders = $request->get('id_userS');
        $id_receiver = $request->get('id_userR');
        $messages = $request->get('message');

        $responseSlim = $client->request('POST', "http://localhost:8080/messages", [
            'json' => [
                'id_userS' => $id_receiver,
                'id_userR' => $id_senders,
                'message' => $messages ,
            ],
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);

        $text = json_decode($responseSlim->getBody());
        $id_messages = $text->data->datas->id;

        $responseExpress = $client->request('POST', "http://localhost:5555/discussion/$idRoom", [
           'json' => [
               'id_messages' => $id_messages,
               'id_senders' => $id_senders,
               'id_receiver' => $id_receiver,
           ],
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);

        return [
            "response" => json_decode($responseExpress->getBody()),
        ];
    }


    public function delete(Request $request, $idRoom, $idMessage) {
        $client = new Client();
        $token = $request->bearerToken();

        $responseExpress = $client->request('DELETE', "http://localhost:5555/discussion/$idRoom/$idMessage", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);

        $responseSlim = $client->request('DELETE', "http://localhost:8080/messages/$idMessage", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);

        return [
            "responseExpress" => json_decode($responseExpress->getBody()),
            "responseSlim" => json_decode($responseSlim->getBody()),
        ];
    }
}
