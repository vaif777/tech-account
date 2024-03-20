<?php

namespace App\Http\Controllers\network_infrastructure;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistributionResource;
use App\Http\Resources\NetworkEquipmentResource;
use App\Models\Building;
use App\Models\Connection;
use App\Models\Device;
use App\Models\Distribution;
use App\Models\FinalLocation;
use App\Models\Floor;
use App\Models\Location;
use App\Models\NetworkEquipment;
use App\Models\PatchPanel;
use App\Models\ReferenceDevice;
use App\Models\ReferenceNetworkEquipment;
use App\Models\ReferenceNetworkEquipmentPort;
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
        $connections = Connection::all();
        $buildings = Building::query()->select('id', 'name')->get();
        $telecomCabinets = TelecommunicationCabinet::query()->select('id', 'name')->get();
        $patchPanels = PatchPanel::query()->select('id', 'name',)->get();
        $networkEquipments = NetworkEquipment::query()->select('id', 'name',)->get();
        $maxPortPatchPanel = PatchPanel::max('count_port');
        $maxPortNetworkEquipment = ReferenceNetworkEquipmentPort::max('before');
        $metworkEquipmentManufactures = ReferenceNetworkEquipment::select('manufacturer')->groupBy('manufacturer')->get();
        $metworkEquipmentModels = ReferenceNetworkEquipment::select('model')->groupBy('model')->get();
        $floorsName = Floor::select('name')->groupBy('name')->get();
        $roomsName = Room::select('name')->groupBy('name')->get();
        //dd(ReferenceNetworkEquipment::select('model')->groupBy('model')->get());


        return view('network_infrastructure.connection.index', [
            'connections' => $connections,
            'buildings' => $buildings,
            'telecomCabinets' => $telecomCabinets,
            'patchPanels' => $patchPanels,
            'networkEquipments' => $networkEquipments,
            'maxPortPatchPanel' => $maxPortPatchPanel,
            'maxPortNetworkEquipment' => $maxPortNetworkEquipment,
            'metworkEquipmentManufactures' => $metworkEquipmentManufactures,
            'metworkEquipmentModels' => $metworkEquipmentModels,
            'floorsName' => $floorsName,
            'roomsName' => $roomsName,
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
        $subscribers = Subscriber::all();
        $referenceDevices = ReferenceDevice::all();


        return view('network_infrastructure.connection.create', [
            'buildings' => $buildings,
            'floors' => $floors,
            'rooms' => $rooms,
            'telecomCabinets' => $telecomCabinets,
            'subscribers' => $subscribers,
            'referenceDevices' => $referenceDevices,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

    $searchs = ["port", 'secondary_port'];

    foreach ( $searchs as $search ) {

        $filteredKeys = collect(array_keys($data))->filter(function ($key) use ($search) {
            return strpos($key, $search) === 0;
        })->implode(',');

        isset($data[$filteredKeys]) ? $data[$search] = $data[$filteredKeys] : '';
        unset($data[$filteredKeys]);
    }

        if (!isset($data['device_id']) && isset($data['reference_device_id'])) {

            $device = Device::create($data);
            $data['device_id'] = $device->id;
            $device->location()->create($data); 
        }

        Connection::create($data);
       
        return redirect()->route('connection.create')->with('success', "Запись добавленна");
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
