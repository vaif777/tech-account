<?php

namespace App\Http\Controllers\network_infrastructure;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Distribution;
use App\Models\FinalLocation;
use App\Models\Floor;
use App\Models\Location;
use App\Models\PatchPanel;
use App\Models\Room;
use App\Models\TelecommunicationCabinet;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distributions = Distribution::all();

        return view('network_infrastructure.distribution.index', [
            'distributions' => $distributions,
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
        $patchPanels = PatchPanel::query()->select('id', 'name', 'count_port')->get();
        $distributions = Distribution::query()->select('patch_panel_id', 'patch_panel_port', 'final_patch_panel_id', 'final_patch_panel_port')->get();

        if ($request->ajax()) {

            $res = [];

            if ($request->building_id) {

                $res['floors'] = $floors->where('building_id', $request->building_id);
            }

            if ($request->floor_id) {

                $res['rooms'] = $rooms->where('floor_id', $request->floor_id);
            }

            if ($request->patch_panel_id) {

                $excludeArray = array_merge($distributions->where('patch_panel_id', $request->patch_panel_id)->pluck('patch_panel_port')->toArray(), $distributions->where('final_patch_panel_id', $request->patch_panel_id)->pluck('final_patch_panel_port')->toArray());

                $res['ports'] = array_diff(range(1, $patchPanels->find($request->patch_panel_id)->count_port), $excludeArray);
            }

            if ($request->filter and ($request->floor_id or $request->building_id or $request->room_id or $request->telecommunication_cabinet_id)) {

                $arguments = [];

                $request->floor_id ? $arguments['floor_id'] = $request->floor_id : '';
                $request->building_id ? $arguments['building_id'] = $request->building_id : '';
                $request->room_id ? $arguments['room_id'] = $request->room_id : '';
                $request->telecommunication_cabinet_id ? $arguments['telecommunication_cabinet_id'] = $request->telecommunication_cabinet_id : '';

                $res['patchPanels'] = $patchPanels->whereIn('id', Location::searchIdArray($arguments, 'App\Models\PatchPanel'));
                $res['telecomCabinets'] = $telecomCabinets->whereIn('id', Location::searchIdArray($arguments, 'App\Models\TelecommunicationCabinet'));
            } else {

                $res['telecomCabinets'] = $telecomCabinets;
                $res['patchPanels'] = $patchPanels;
            }

            if ($request->telecommunication_cabinet_id or $request->patch_panel_id) {

                if ($request->telecommunication_cabinet_id && $request->cabinetPatch) {

                    $arguments = [];
                    $arguments['telecommunication_cabinet_id'] = $request->telecommunication_cabinet_id;

                    $res['patchPanels'] = $patchPanels->whereIn('id', Location::searchIdArray($arguments, 'App\Models\PatchPanel'));
                }

                $request->patch_panel_id ? $res['locations'] = $patchPanels->find($request->patch_panel_id)->location : $res['locations'] = $telecomCabinets->find($request->telecommunication_cabinet_id)->location;
                $res['locations']->telecommunication_cabinet_id ? $res['telecomCabinet'] = $telecomCabinets->find($res['locations']->telecommunication_cabinet_id) : '';
                $res['locations']->floor_id ? $res['floors'] = $floors->where('building_id', $res['locations']->building_id) : '';
                $res['locations']->room_id ? $res['rooms'] = $rooms->where('floor_id', $res['locations']->floor_id) : '';

            }

            $res['patchPanelsAll'] = $patchPanels;
            $res['telecomCabinetsAll'] = $telecomCabinets;
            return $res;
        }

        return view('network_infrastructure.distribution.create', [
            'buildings' => $buildings,
            'floors' => $floors,
            'rooms' => $rooms,
            'telecomCabinets' => $telecomCabinets,
            'patchPanels' => $patchPanels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        if (!$data['final_patch_panel_id'] && !$data['patch_panel_id']) {

            $arguments = [];

            $request->floor_id ? $arguments['floor_id'] = $data['floor_id'] : '';
            $request->building_id ? $arguments['building_id'] = $data['building_id'] : '';
            $request->room_id ? $arguments['room_id'] = $data['room_id'] : '';
            $request->telecommunication_cabinet_id ? $arguments['telecommunication_cabinet_id'] = $data['telecommunication_cabinet_id'] : '';

            $allPatchCordsLocation = Distribution::query()->select('patch_cord_number')->whereIn('id', location::searchIdArray( $arguments, 'App\Models\Distribution'))->orderBy('patch_cord_number')->pluck('patch_cord_number')->toArray();

            if (!empty($allPatchCordsLocation)) {

                $patchCordNumber = $this->findMissingIncrement($allPatchCordsLocation);

                if ($patchCordNumber) {

                    $data['patch_cord_number'] = --$patchCordNumber;
                } else {

                    $patchCordNumber = array_pop($allPatchCordsLocation);

                    $data['patch_cord_number'] = ++$patchCordNumber;
                }

            } else {

                $data['patch_cord_number'] = 1;
            }
        }

        $distribution = Distribution::create($data);
        $distribution->location()->create($data);
        $distribution->finalLocation()->create($data);

        return redirect()->route('distribution.create')->with('success', "Запись добавленна");
    }

    public function findMissingIncrement($arr)
    {
        // Используем array_map для создания массива, в котором каждый элемент - разница между текущим и предыдущим элементами
        $differences = array_map(function ($key) use ($arr) {
            if ($key > 0) {
                return $arr[$key] - $arr[$key - 1];
            }
            return null;
        }, array_keys($arr));

        // Ищем первое значение в массиве разностей, равное 2
        $key = array_search(2, $differences);

        // Если такое значение найдено, возвращаем элемент, следующий за ним в исходном массиве
        if ($key !== false) {
            return $arr[$key];
        }

        return false;
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
