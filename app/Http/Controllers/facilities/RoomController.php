<?php

namespace App\Http\Controllers\facilities;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = Building::query()->select()->get();
        $rooms = Room::query()->select()->get();
        // $buildings = Building::query()->select()->get();

        // if ($id != 'all') {
        //     $floors = Floor::query()->select()->where('building_id', $id)->get();
        // } else {
        //     $floors = Floor::query()->select()->get();
        // }

        // if ($request->ajax()) {
            
        //     if ($request->building_id != 'all') {
        //         return DB::table('floors')
        //             ->join('buildings', 'floors.building_id', '=', 'buildings.id')
        //             ->select('floors.id', 'floors.name', 'floors.building_id', 'buildings.name as building_name')
        //             ->where('floors.building_id', $request->building_id)
        //             ->get();
        //     } else {
        //         return DB::table('floors')
        //             ->join('buildings', 'floors.building_id', '=', 'buildings.id')
        //             ->select('floors.id', 'floors.name', 'floors.building_id', 'buildings.name as building_name')
        //             ->get();
        //     }

        // }

        return view('room.index', [
            'rooms' => $rooms,
            'buildings' => $buildings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
