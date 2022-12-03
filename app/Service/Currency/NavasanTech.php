<?php

namespace App\Service\Currency;

use Illuminate\Support\Facades\Http;

class NavasanTech implements ICurrency
{


    protected $baseURL = "http://api.navasan.tech";
    protected $apiKey  = "freeneieKsR1cEZ3UCigCsMOcygzqKM7";


    public function getCurrencyPrice()
    {
        $response = Http::timeout(5)->get("$this->baseURL/latest/?api_key=$this->apiKey");

        if ($response->ok()) {
            return $response->json();
        } else {
            return null;
        }
    }
}
