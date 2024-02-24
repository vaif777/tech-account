<?php

namespace App\Http\Controllers\network_infrastructure;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Distribution;
use App\Models\FinalLocation;
use App\Models\Floor;
use App\Models\Location;
use App\Models\NetworkEquipment;
use App\Models\Room;
use App\Models\Subscriber;
use App\Models\TelecommunicationCabinet;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $subscribers = Subscriber::all();
        $distributions = Distribution::all();
        $networkEquipments = NetworkEquipment::all();

        if ($request->ajax()) {

            
            $res = [];

            // if ($request->building_id) {
                
            //     $res['floors'] = $floors->where('building_id', $request->building_id); 
            // }

            // if ($request->floor_id) {

            //     $res['rooms'] = $rooms->where('floor_id', $request->floor_id);
            // }

            if ($request->floor_id or $request->building_id or $request->room_id or $request->telecommunication_cabinet_id) {

                $arguments = [];

                $request->floor_id ? $arguments['final_floor_id'] = $request->floor_id : '';
                $request->building_id ? $arguments['final_building_id'] = $request->building_id : '';
                $request->room_id ? $arguments['final_room_id'] = $request->room_id : '';
                $request->telecommunication_cabinet_id ? $arguments['final_telecommunication_cabinet_id'] = $request->telecommunication_cabinet_id : '';

                $distributions = $distributions->whereIn('id', FinalLocation::searchIdArray($arguments, 'App\Models\Distribution'));

                $arguments = [];
                $equipments = [];

                foreach ($distributions as $distribution) {

                    $distribution->patchPanel;
                    $distribution->finalPatchPanel; 
                    $distribution->location->telecommunicationCabinet;

                    $distribution->location->floor_id ? $arguments['floor_id'] = $distribution->location->floor_id : '';
                    $distribution->location->building_id ? $arguments['building_id'] = $distribution->location->building_id : '';
                    $distribution->location->room_id ? $arguments['room_id'] = $distribution->location->room_id : '';
                    $distribution->location->telecommunicationCabinet->id ? $arguments['telecommunication_cabinet_id'] = $distribution->location->telecommunicationCabinet->id : '';

                    $equipments[] = $networkEquipments->whereIn('id', Location::searchIdArray($arguments, 'App\Models\NetworkEquipment'))->first();
                    
                    $arguments = [];
                }
                
                $equipments = (object) $equipments;

                foreach ($equipments as $equipment) {
                    
                    $equipment->referenceNetworkEquipment->networkEquipmentPorts;
                }

                $res['distributions'] = $distributions;
                $res['equipments'] = $equipments;
            } 
            // else {

            //     $res['telecomCabinets'] = $telecomCabinets;
            // }

            // if ($request->telecommunication_cabinet_id) {

            //     $res['locations'] = $telecomCabinets->find($request->telecommunication_cabinet_id)->location;
            //     $res['locations']->floor_id ? $res['floors'] = $floors->where('building_id', $res['locations']->building_id) : '';
            //     $res['locations']->room_id ?  $res['rooms'] = $rooms->where('floor_id', $res['locations']->floor_id) : '';
                
            // }
             
            // $res['telecomCabinetsAll'] = $telecomCabinets;
            return $res;
        }

        return view('network_infrastructure.connection.create', [
            'buildings' => $buildings,
            'floors' => $floors,
            'rooms' => $rooms,
            'telecomCabinets' => $telecomCabinets,
            'subscribers' => $subscribers,
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
