<?php

namespace App\Http\Controllers\facilities;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id)
    {
        $buildings = Building::query()->select()->get();

        if ($id != 'all') {
            $floors = Floor::query()->select()->where('building_id', $id)->get();
        } else {
            $floors = Floor::query()->select()->get();
        }

        if ($request->ajax()) {
            
            if ($request->building_id != 'all') {
                return DB::table('floors')
                    ->join('buildings', 'floors.building_id', '=', 'buildings.id')
                    ->select('floors.id', 'floors.name', 'floors.building_id', 'buildings.name as building_name')
                    ->where('floors.building_id', $request->building_id)
                    ->get();
            } else {
                return DB::table('floors')
                    ->join('buildings', 'floors.building_id', '=', 'buildings.id')
                    ->select('floors.id', 'floors.name', 'floors.building_id', 'buildings.name as building_name')
                    ->get();
            }

        }

        return view('floor.index', [
            'floors' => $floors,
            'buildings' => $buildings,
            'building_id' => $id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buildings = Building::query()->select()->get();
        return view('floor.create', [
            'buildings' => $buildings
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'building_id' => 'required',
            'name' => 'required',
            'from' => 'nullable|integer',
            'before' => 'nullable|integer',
        ]);

        $data = $request->all();
        $floor = Floor::create($data);
        $rooms = [];

        if ($data['homemade']) {
            $homemade = explode(",", strip_tags(str_replace(' ', '',preg_replace('/\r\n|\r|\n/u', '',$data['homemade']))));

            foreach ($homemade as $v) {
                $rooms[] = new Room(['name' => $v]);
            }
        }

        if ($data['from'] and $data['before']) {

            for ($i = $data['from']; $i <= $data['before']; $i++) {
                $rooms[] = new Room(['name' => $i]);
            }

        } 
        
        if ($rooms) {
            $floor->rooms()->saveMany($rooms);
        }
        elseif ($data['from'] and !$data['before']) {
            $floor->rooms()->create(['name' => $data['from']]);
        }

        return redirect()->route('floor.create')->with('success', 'Этаж добавлен');
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
