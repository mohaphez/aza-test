<?php

namespace App\Interfaces;

interface HotelRepositoryInterface
{
    public function get();
    public function like($column, $string);
    public function groupBy($column);
    public function limit($number);
    public function getSelectColumn($select);
    public function getHotelByCity($cityID);
    public function getCheapHotels();
    public function getPopularHotels();
}
