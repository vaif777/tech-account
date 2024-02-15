<?php

namespace App\Http\Controllers\network_infrastructure;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use App\Models\PatchPanel;
use App\Models\PatchPanelPort;
use App\Models\Room;
use App\Models\TelecommunicationCabinet;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$materials = Material::query()->select()->get();
        
        return view('network_infrastructure.distribution.index', [
            'telecommCabinets' => [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $buildings = Building::query()->select('id', 'name')->get();
        $floors = Floor::query()->select('id', 'name', 'building_id')->get();
        $rooms = Room::query()->select('id', 'name', 'floor_id')->get();
        $telecomCabinets = TelecommunicationCabinet::query()->select('id', 'name', 'floor_id', 'building_id', 'room_id')->get();
        $patchPanels = PatchPanel::query()->select()->get();

        //dd($telecomCabinets = TelecommunicationCabinet::query()->select()->where(['floor_id' => 18, 'room_id' => 11, 'building_id' => 25, 'id' => 6])->get());

        if ($request->ajax()) {
            
            $res = [];

            if ($request->building_id) {
                
                $res['floors'] = $floors->where('building_id', $request->building_id); 
            }

            if ($request->floor_id) {

                $res['rooms'] = $rooms->where('floor_id', $request->floor_id);
            }

            if ($request->patch_panel_id) {

                $res['ports'] = PatchPanelPort::query()->select('id', 'number')->where('patch_panel_id', $request->patch_panel_id)->get();
            }

            if ($request->telecommunication_cabinet_id or $request->patch_panel_id) {

                $res['facilityId'] = $telecomCabinets->find($request->telecommunication_cabinet_id);
                $res['buildings'] = $buildings;
                $res['facilityId']->floor_id ? $res['floors'] = $floors->where('building_id', $res['facilityId']->building_id) : '';
                $res['facilityId']->room_id ?  $res['rooms'] = $rooms->where('floor_id', $res['facilityId']->floor_id) : '';
                
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

            if ($request->floor_id or $request->building_id or $request->room_id or $request->telecommunication_cabinet_id) {

                $arguments = [];

                $request->floor_id ? $arguments['floor_id'] = $request->floor_id : '';
                $request->building_id ? $arguments['building_id'] = $request->building_id : '';
                $request->room_id ? $arguments['room_id'] = $request->room_id : '';
                $request->telecommunication_cabinet_id ? $arguments['id'] = $request->telecommunication_cabinet_id : '';

                $res['patchPanels'] = PatchPanel::filterPatchPanel($arguments);
            } else {

                $res['patchPanels'] = PatchPanel::query()->select('id', 'name')->get();
            }
             
            return $res;
        }

        return view('network_infrastructure.distribution.create', [
            'buildings' => $buildings,
            'floors' => $floors,
            'rooms' => $rooms,
            'telecomCabinets' => $telecomCabinets,
            'patchPanels' => $patchPanels,
        ]);
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
