<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');
        $client = new Client();
        $response = $client->request('POST', 'http://localhost:8080/auth', [
            'json' => [
                'username' => $username,
                'password' => $password,
            ]
        ]);

        return [
            "response" => json_decode($response->getBody()),
        ];
    }

    public function register(Request $request){
        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $phone = $request->get('phone');

        $client = new Client();
        $response = $client->request('POST', 'http://localhost:8080/users/register', [
            'json' => [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'phone' => $phone,
            ]
        ]);

        return [
            "response" => json_decode($response->getBody()),
        ];
    }


}
