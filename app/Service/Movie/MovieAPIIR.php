<?php

namespace App\Service\Movie;

use Illuminate\Support\Facades\Http;

class MovieAPIIR implements IMovie
{

    private $mainURL = 'http://moviesapi.ir/api/v1';

    public function searchByName($query)
    {
        $response = Http::timeout(5)->get("$this->mainURL/movies", [
            'q' => $query["name"],
            'page' => $query["page"],
        ]);

        if ($response->ok()) {
            return $response->json();
        } else {
            return null;
        }
    }
}
