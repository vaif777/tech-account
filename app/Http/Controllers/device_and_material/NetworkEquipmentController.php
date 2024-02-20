<?php

namespace App\Http\Controllers\device_and_material;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Location;
use App\Models\NetworkEquipment;
use App\Models\Room;
use App\Models\TelecommunicationCabinet;
use Illuminate\Http\Request;

class NetworkEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $networkEquipments = NetworkEquipment::All();

        if ($request->ajax()) {

            if ($request->id) {
                
                $networkEquipments->find($request->id)->update(['pattern' => 1]); 
            }
        }

        return view('device_and_material.network_equipment.index', [
            'networkEquipments' => $networkEquipments,
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
        $telecomCabinets = TelecommunicationCabinet::query()->select('id', 'name')->get();

        if ($request->ajax()) {
            
            $res = [];

            if ($request->building_id) {
                
                $res['floors'] = $floors->where('building_id', $request->building_id); 
            }

            if ($request->floor_id) {

                $res['rooms'] = $rooms->where('floor_id', $request->floor_id);
            }

            if ($request->filter and ($request->floor_id or $request->building_id or $request->room_id or $request->telecommunication_cabinet_id)) {

                $arguments = [];

                $request->floor_id ? $arguments['floor_id'] = $request->floor_id : '';
                $request->building_id ? $arguments['building_id'] = $request->building_id : '';
                $request->room_id ? $arguments['room_id'] = $request->room_id : '';
                $request->telecommunication_cabinet_id ? $arguments['telecommunication_cabinet_id'] = $request->telecommunication_cabinet_id : '';

                $res['telecomCabinets'] = $telecomCabinets->whereIn('id', Location::searchIdArray($arguments, 'App\Models\TelecommunicationCabinet'));
            } else {

                $res['telecomCabinets'] = $telecomCabinets;
            }

            if ($request->telecommunication_cabinet_id) {

                $res['locations'] = $telecomCabinets->find($request->telecommunication_cabinet_id)->location;
                $res['locations']->floor_id ? $res['floors'] = $floors->where('building_id', $res['locations']->building_id) : '';
                $res['locations']->room_id ?  $res['rooms'] = $rooms->where('floor_id', $res['locations']->floor_id) : '';
                
            }
             
            $res['telecomCabinetsAll'] = $telecomCabinets;
            return $res;
        }

        return view('device_and_material.network_equipment.create', [
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
        dd($request->all());
        $data = $request->all();
        $data['count_port'] = $data['before'];

        $networkEquipment = NetworkEquipment::create($data);
        $networkEquipment->location()->create($data);

        if ($data['from'] && !$data['before']) {

            $data['number'] = $data['from'];

            $networkEquipment->networkEquipmentPorts()->create($data);
        } else {

            for ($i = $data['from']; $i <= $data['before']; ++$i) {
                
                $data['number'] = $i;

                $networkEquipment->networkEquipmentPorts()->create($data);
            }
        }
     
        return redirect()->route('network-equipment.create')->with('success', 'Запись добавленна');
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
