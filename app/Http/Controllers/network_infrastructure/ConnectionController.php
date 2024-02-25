<?php

namespace App\Http\Controllers\network_infrastructure;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Device;
use App\Models\Distribution;
use App\Models\FinalLocation;
use App\Models\Floor;
use App\Models\Location;
use App\Models\NetworkEquipment;
use App\Models\ReferenceDevice;
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
        $referenceDevices = ReferenceDevice::all();
        $devices = Device::all();

        if ($request->ajax()) {
            
            $res = [];

            if ($request->floor_id or $request->building_id or $request->room_id or $request->telecommunication_cabinet_id) {

                $arguments = [];
                $isNull = [];

                $request->floor_id ? $arguments['final_floor_id'] = $request->floor_id : $isNull[] = 'final_floor_id';
                $request->building_id ? $arguments['final_building_id'] = $request->building_id : '';
                $request->room_id ? $arguments['final_room_id'] = $request->room_id :$isNull[] = 'final_room_id';
                $request->telecommunication_cabinet_id ? $arguments['final_telecommunication_cabinet_id'] = $request->telecommunication_cabinet_id : $isNull[] = 'final_telecommunication_cabinet_id';

                $distributions = $distributions->whereIn('id', FinalLocation::searchIdArray($arguments, 'App\Models\Distribution', $isNull));

                $arguments = [];
                $equipments = [];

                foreach ($distributions as $distribution) {

                    $distribution->patchPanel;
                    $distribution->finalPatchPanel; 
                    $distribution->location->telecommunicationCabinet;

                    $distribution->location->floor_id ? $arguments['floor_id'] = $distribution->location->floor_id : '';
                    $distribution->location->building_id ? $arguments['building_id'] = $distribution->location->building_id : '';
                    $distribution->location->room_id ? $arguments['room_id'] = $distribution->location->room_id : '';
                    $distribution->location->telecommunication_cabinet_id ? $arguments['telecommunication_cabinet_id'] = $distribution->location->telecommunication_cabinet_id : '';

                    $searchIdArray = Location::searchIdArray($arguments, 'App\Models\NetworkEquipment');

                    if ($searchIdArray) {

                        $equipments[] = $networkEquipments->whereIn('id', $searchIdArray)->first();
                    }

                    $arguments = [];
                }
                
                $equipments = (object) $equipments;

                if ($equipments) {

                    foreach ($equipments as $equipment) {
                        
                        $equipment->referenceNetworkEquipment->networkEquipmentPorts;
                    }
                }

                $res['distributions'] = $distributions;
                $res['equipments'] = $equipments;
            } 

            if ($request->referenceDevice) {

                $res['referenceDevices'] = $referenceDevices;    
            }

            if ($request->subscriber_id) {

                $devices = $devices->where('subscriber_id', $request->subscriber_id); 
                
                foreach ($devices as $device) {

                    $device->referenceDevice;
                }

                $res['devices'] = $devices; 
            }

            if ($request->telecommunication_cabinet_id) {

                $arguments['telecommunication_cabinet_id'] = $request->telecommunication_cabinet_id;
                $searchIdArray = Location::searchIdArray($arguments, 'App\Models\NetworkEquipment');
                $finalEquipments = $networkEquipments->whereIn('id', $searchIdArray); 
                
                foreach ($finalEquipments as $finalEquipment) {

                    $finalEquipment->referenceNetworkEquipment->networkEquipmentPorts;;
                }

                $res['finalEquipments'] = $finalEquipments; 
            }
        
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
