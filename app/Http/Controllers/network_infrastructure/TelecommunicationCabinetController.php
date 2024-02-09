<?php

namespace App\Http\Controllers\network_infrastructure;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;

class TelecommunicationCabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cabinet.index', [
            //'buildings' => json_encode($buildings->toArray()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $buildings = Building::query()->select('id', 'name')->get();

        if($request->ajax()){
            return Floor::query()->select('id', 'name')->where('building_id', $request->building_id)->orderBy('name')->get()->toArray();
        }

        return view('cabinet.create', [
            'buildings' => json_encode($buildings->toArray()),
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
