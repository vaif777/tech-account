<?php

namespace App\Http\Controllers\facilities;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = Building::query()->select()->get();

        return view('building.index', [
            'buildings' => $buildings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('building.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'from' => 'nullable|integer',
            'before' => 'nullable|integer',
        ]);

        $data = $request->all();
        $building = Building::create($data);

        if ($data['from'] and $data['before']) {

            $floors = [];
            for ($i = $data['from']; $i <= $data['before']; $i++) {
                $floors[] = new Floor(['name' => $i]);
            }

            if ($data['homemade']) {
                $homemade = explode( ',', $data['homemade'] );
                
                foreach ($homemade as $v) {
                    $floors[] = new Floor(['name' => $v]);
                }
            }

            $building->floors()->saveMany($floors);

        } elseif ($data['from'] and !$data['before']) {
            $building->floors()->create(['name' => $data['from']]);
        }

        return redirect()->route('building.create')->with('success', 'Здание добавлено');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $building = Building::query()->find($id);
        $foolrs = $building->floors()->orderBy('name')->get();

        return view('building.show', [
            'building' => $building,
            'foolrs' => $foolrs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $building = Building::query()->find($id);

        return view('building.edit', [
            'building' => $building,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $building = Building::query()->find($id);

        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $data = $request->all();
        $building->update($data);

        return redirect()->route('building.edit', ['building' => $building->id])->with('success', 'Здание отредактирован');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $building = Building::query()->find($id);
       
        if($building->floors->count()) return redirect()->route('building.index')->with('error', 'Здание нельзя удалить есть связи.');
        $building->delete();

        return redirect()->route('building.index')->with('success', 'Здание удален');
    }
}
