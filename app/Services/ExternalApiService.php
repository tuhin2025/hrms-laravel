<?php

namespace App\services;

use Illuminate\Support\Facades\Http;


class ExternalApiService
{

    public function getUsers()
    {


        try {
            $response = Http::timeout(20)->get('https://jsonplaceholder.typicode.com/users');


            if ($response->successful()) {
                return [
                    "success" => true,
                    "message" => "Data Found",
                    "data" => $response->json(),
                    "errors" => null
                ];
            }

            return [];

        } catch (\Exception $e) {
            return [];


        }

    }


}
