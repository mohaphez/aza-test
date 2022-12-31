<?php

namespace App\Repositories;

use App\Interfaces\HotelRepositoryInterface;
use Illuminate\Support\Facades\DB;

class HotelRepository implements HotelRepositoryInterface
{
    protected $query;


    public function __construct()
    {
        $this->query = DB::table('hotel');
    }

    public function get()
    {
        return $this->query->get();
    }

    public function groupBy($column)
    {
        $this->query->groupBy($column);
        return $this;
    }

    public function like($column, $string)
    {
        $this->query->where($column, 'like', '%' . $string . '%');
        return $this;
    }

    public function limit($number)
    {
        $this->query->limit($number);
        return $this;
    }

    public function skip($number)
    {
        $this->query->skip($number);
        return $this;
    }

    public function getSelectColumn($select)
    {
        $this->query->select($select);
        return $this;
    }

    public function getHotelByCity($cityID)
    {
        $this->query->where('PlaceID', $cityID);
        return $this;
    }

    public function getCheapHotels()
    {
        $this->query->whereNotNull('MinRate')
            ->orderBy(DB::raw('CAST(MinRate AS FLOAT)'));
        return $this;
    }


    public function getPopularHotels()
    {
        $this->query->whereNotNull('MinRate')
            ->whereNotNull('Popularity')
            ->orderBy(DB::raw('CAST(Popularity AS INTEGER)'));
        return $this;
    }
}
