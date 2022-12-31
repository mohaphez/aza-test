<?php

namespace App\Http\Controllers;

use App\Models\SearchLog;
use App\Repositories\HotelRepository;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function search(Request $request)
    {
        $this->validate($request, ['q' => 'required|string']);
        $popular = new HotelRepository();
        $cheap  = new HotelRepository();

        $popular = $popular->getSelectColumn(['PlaceName', 'MinRate', 'HotelName', 'PlaceID'])
            ->getHotelByCity($request->get('q'))
            ->getPopularHotels()
            ->limit(1)
            ->get();

        $cheap = $cheap->getSelectColumn(['PlaceName', 'MinRate', 'HotelName', 'PlaceID'])
            ->getHotelByCity($request->get('q'))
            ->getCheapHotels()
            ->limit(1)
            ->get();

        $data = ['data' => ['popular' => $popular, 'cheap' => $cheap]];

        SearchLog::create(['ip' => $request->ip(), 'input' => json_encode($request->all()), 'result' => json_encode($data)]);

        return response()->json($data);
    }


    public function getCities(Request $request)
    {
        $cities = new HotelRepository();
        $cities = $cities->getSelectColumn(['PlaceName as name', 'PlaceID as value'])
            ->groupBy('PlaceID')
            ->like('PlaceName', $request->get('name'))
            ->get();

        return response()->json(['data' => $cities]);
    }
}
