<?php

namespace App\Http\Controllers\device_and_material;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialsReference;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::query()->select()->get();
        
        return view('device_and_material.material.index', [
            'materials' => $materials,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materialReferences = MaterialsReference::query()->select()->get();
        
        return view('device_and_material.material.create', [
            'materialReferences' => $materialReferences
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
