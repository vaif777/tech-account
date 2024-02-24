<?php

namespace App\Http\Controllers\device_and_material;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Device;
use App\Models\ReferenceDevice;
use App\Models\Subscriber;
use App\Models\TelecommunicationCabinet;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $device = Device::all();

        return view('device_and_material.device.index', [
            'devices' =>  $device,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subscribers = Subscriber::all();
        $referenceDevice = ReferenceDevice::all();
        $buildings = Building::all();
        $telecomCabinets = TelecommunicationCabinet::all();
        
        return view('device_and_material.device.create', [
            'subscribers' =>  $subscribers,
            'referenceDevices' => $referenceDevice,
            'buildings' => $buildings,
            'telecomCabinets' => $telecomCabinets,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->all();

        $device = Device::create($data);
        $device->location()->create($data); 

        return redirect()->route('device.create')->with('success', 'Запись добавленна');
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
