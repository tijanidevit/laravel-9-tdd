<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\Hotel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class HotelController extends Controller
{
    public function store(StoreHotelRequest $request) : RedirectResponse
    {
        $data = $request->validated();
        $hotel = Hotel::create($data);
        return redirect()->route('all_hotels');
    }

    public function update(UpdateHotelRequest $request, Hotel $hotel) : RedirectResponse
    {
        $data = $request->validated();
        $hotel->update($data);
        return $hotel->path();

    }
    public function destroy( Hotel $hotel) : RedirectResponse
    {
        $hotel = $hotel->delete();

        return redirect()->route('all_hotels');
    }

    public function index(): View
    {
        $hotels = Hotel::all();
        return view('', compact('hotels'));
    }
}
