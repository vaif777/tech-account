<?php

namespace App\Http\Controllers\device_and_material;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use App\Models\PatchPanel;
use App\Models\Room;
use App\Models\TelecommunicationCabinet;
use Illuminate\Http\Request;

class PatchPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patchPanels = PatchPanel::query()->select()->get();

        return view('device_and_material.patch_panel.index', [
            'patchPanels' => $patchPanels,
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
        $telecomCabinets = TelecommunicationCabinet::query()->select('id', 'name')->get();

        if ($request->ajax()) {
            
            $res = [];

            if ($request->building_id) {

                $res['floors'] = Floor::query()->select('id', 'name')->where('building_id', $request->building_id)->get(); 
            }

            if ($request->floor_id) {

                $res['rooms'] = Room::query()->select('id', 'name')->where('floor_id', $request->floor_id)->get();
            }

            if ($request->floor_id or $request->building_id or $request->room_id) {

                $arguments = [];

                $request->floor_id ? $arguments['floor_id'] = $request->floor_id : '';
                $request->building_id ? $arguments['building_id'] = $request->building_id : '';
                $request->room_id ? $arguments['room_id'] = $request->room_id : '';

                $res['telecomCabinets'] = TelecommunicationCabinet::query()->select('id', 'name')->where($arguments)->get();
            } else {

                $res['telecomCabinets'] = TelecommunicationCabinet::query()->select('id', 'name')->get();
            }
             
            return $res;
        }

        return view('device_and_material.patch_panel.create', [
            'buildings' => $buildings,
            'floors' => $floors,
            'rooms' => $rooms,
            'telecomCabinets' => $telecomCabinets,
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
            'unit' => 'integer',
            'count_port' => 'integer',
        ]);

        $patchPanel = PatchPanel::create($request->all());

        for ($i = 1; $i <= $request->count_port; ++$i){
            $patchPanel->PatchPanelPorts()->create([
                'number' => $i,
            ]);
        }

        return redirect()->route('patch-panel.create')->with('success', 'Запись добавленна');
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
