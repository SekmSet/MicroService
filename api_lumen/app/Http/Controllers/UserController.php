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

    public function update(Request $request, $id){
        $client = new Client();
        $token = $request->bearerToken();

        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $phone = $request->get('phone');

        /*$slimUser =  $client->request('GET', "http://localhost:8080/users/$id", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);*/

       /* $user = json_decode($slimUser->getBody());*/

        $query = [];

        if($first_name){
            $query['first_name'] = $first_name;
        }

        if($last_name){
            $query['last_name'] = $last_name;
        }

        if($username){
            $query['username'] = $username;
        }

        if($email){
            $query['email'] = $email;
        }

        if($password){
            $query['password'] = $password;
        }

        if($phone){
            $query['phone'] = $phone;
        }

        $response = $client->request('PUT', "http://localhost:8080/users/$id", [
            'json' => $query,
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);

        return [
            "response" => json_decode($response->getBody()),
        ];
    }

    public function delete(Request $request, $id){
        $client = new Client();
        $token = $request->bearerToken();

        $responseSlim = $client->request('DELETE', "http://localhost:8080/users/$id", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);

        return [
            "response" => json_decode($responseSlim->getBody()),
        ];
    }
}
