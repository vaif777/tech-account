<?php

namespace App\Http\Controllers\reference;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Location;
use App\Models\NetworkEquipment;
use App\Models\ReferenceNetworkEquipment;
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
        $networkEquipment = ReferenceNetworkEquipment::All();

        return view('reference.network_equipment.index', [
            'networkEquipments' =>  $networkEquipment,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
     
        return view('reference.network_equipment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $data = $request->all();

        $networkEquipment = ReferenceNetworkEquipment::create($data);
        $networkEquipment->networkEquipmentPorts()->createMany($data['port']);

        return redirect()->route('reference-network-equipment.create')->with('success', 'Запись добавленна');
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
