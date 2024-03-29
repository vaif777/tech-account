<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id)
    {
        $buildings = Building::query()->select()->get();

        if ($id != 'all') {
            $floors = Floor::query()->select()->where('building_id', $id)->get();
        } else {
            $floors = Floor::query()->select()->get();
        }

        if ($request->ajax()) {
            
            if ($request->building_id != 'all') {
                return DB::table('floors')
                    ->join('buildings', 'floors.building_id', '=', 'buildings.id')
                    ->select('floors.id', 'floors.name', 'floors.building_id', 'buildings.name as building_name')
                    ->where('floors.building_id', $request->building_id)
                    ->get();
            } else {
                return DB::table('floors')
                    ->join('buildings', 'floors.building_id', '=', 'buildings.id')
                    ->select('floors.id', 'floors.name', 'floors.building_id', 'buildings.name as building_name')
                    ->get();
            }

        }

        return view('floor.index', [
            'floors' => $floors,
            'buildings' => $buildings,
            'building_id' => $id
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
