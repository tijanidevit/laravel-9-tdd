<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function store(StoreHotelRequest $request)
    {
        $data = $request->validated();
        $hotel = Hotel::create($data);
    }

    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        $data = $request->validated();
        $hotel = $hotel->update($data);
    }

    public function index()
    {
        dd(Hotel::all());
    }
}
