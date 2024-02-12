<?php

namespace App\Http\Controllers\device_and_material;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Room;
use App\Models\TelecommunicationCabinet;
use Illuminate\Http\Request;

class TelecommunicationCabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $telecommCabinets = TelecommunicationCabinet::all();

        return view('device_and_material.cabinet.index', [
            'telecommCabinets' => $telecommCabinets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $buildings = Building::query()->select('id', 'name')->get();
        $floors = Floor::query()->select('id', 'name')->get();
        $rooms = Room::query()->select('id', 'name')->get();

        return view('device_and_material.cabinet.create', [
            'buildings' => $buildings,
            'floors' => $floors,
            'rooms' => $rooms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'manufacturer_id' => 'nullable|integer',
            'model_id' => 'nullable|integer',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'depth' => 'nullable|integer',
            'unit' => 'nullable|integer',
        ]);

        TelecommunicationCabinet::create($request->all());

        return redirect()->route('telecom-cabinet.create')->with('success', 'Запись добавленна');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}