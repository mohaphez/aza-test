<?php

namespace App\Http\Controllers;

use App\Service\Movie\IMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MovieController extends Controller
{
    function __invoke(Request $request, IMovie $movie)
    {
        $request->validate(['q' => 'required|string']);
        $result = $movie->searchByName(["name" => $request->input('q'), "page" => $request->input('page', 1)]);
        if ($result) {
            Cache::put($request->getRequestUri(), json_encode($result), now()->addMinutes(30));
            return response()->json($result);
        }

        return response()->json([], 504);
    }
}
