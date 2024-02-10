<?php

namespace App\Http\Controllers\reference;

use App\Http\Controllers\Controller;
use App\Models\MaterialsReference;
use Illuminate\Http\Request;

class MaterialsReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = MaterialsReference::query()->select()->get();
        return view('reference.material.index', [
            'materials' => $materials,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reference.material.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        MaterialsReference::create($data);

        return redirect()->route('material.create')->with('success', 'Запись добавленна');
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
