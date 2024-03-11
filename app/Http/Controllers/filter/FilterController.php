<?php

namespace App\Http\Controllers\filter;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistributionResource;
use App\Http\Resources\NetworkEquipmentResource;
use App\Models\Distribution;
use App\Models\FinalLocation;
use App\Models\Floor;
use App\Models\Location;
use App\Models\NetworkEquipment;
use App\Models\PatchPanel;
use App\Models\Room;
use App\Models\TelecommunicationCabinet;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function location(Request $request)
    {

        $arguments = $request->all();

        $isFinal = $arguments['isFinal'] == 'true';
        unset($arguments['isFinal']);

        if (!empty($arguments['telecommunication_cabinet_id']) || !empty($arguments['patch_panel_id'])) {

            if (!isset($arguments['telecommunication_cabinet_id']) && !empty($arguments['patch_panel_id'])) {

                $res['locations'] = PatchPanel::query()->select()->find($arguments['patch_panel_id'])->location;

                $res['locations']->telecommunication_cabinet_id ? $res[$isFinal ? 'finalTelecomCabinets' : 'telecomCabinets'] = TelecommunicationCabinet::query()->select('id', 'name')->where('id', $res['locations']->telecommunication_cabinet_id)->get() : $res[$isFinal ? 'finalTelecomCabinets' : 'telecomCabinets'] = [];

                $excludeArray = array_merge(Distribution::query()->where('patch_panel_id', $arguments['patch_panel_id'])->pluck('patch_panel_port')->toArray(), Distribution::query()->where('final_patch_panel_id', $arguments['patch_panel_id'])->pluck('final_patch_panel_port')->toArray());

                $res[$isFinal ? 'finalPatchPanelPorts' : 'patchPanelPorts'] = array_diff(range(1, PatchPanel::query()->find($arguments['patch_panel_id'])->count_port), $excludeArray);
            } else {

                $res['locations'] = TelecommunicationCabinet::query()->select()->find($arguments['telecommunication_cabinet_id'])->location;

                $searchIdArray = Location::searchIdArray(['telecommunication_cabinet_id' => $arguments['telecommunication_cabinet_id']],'App\Models\PatchPanel');
                count($searchIdArray) ? $res[$isFinal ? 'finalPatchPanels' : 'patchPanels'] = PatchPanel::query()->select('id', 'name', 'count_port')->whereIn('id', $searchIdArray)->get() : $res[$isFinal ? 'finalPatchPanels' : 'patchPanels'] = [];
            }
            
            $res[$isFinal ? 'finalBuildings' : 'buildings'] = [];

            $res[$isFinal ? 'finalFloors' : 'floors'] = Floor::query()->select('id', 'name', 'building_id')->where('building_id', $res['locations']->building_id)->get();
            
            $res['locations']->room_id ?  $res[$isFinal ? 'finalRooms' : 'rooms'] =  $res[$isFinal ? 'finalFloors' : 'floors']->find($res['locations']->floor_id)->rooms : $res[$isFinal ? 'finalRooms' : 'rooms'] = [];

            return $res;
        }

        foreach ($arguments as $k => $v){

            if ($k == 'building_id' && !empty($arguments['building_id']) && !isset($arguments['floor_id'])) {

                $res[$isFinal ? 'finalFloors' : 'floors'] = Floor::query()->select('id', 'name', 'building_id')->where($k, $v)->get();
            } 

            if ($k == 'floor_id' && !empty($arguments['floor_id']) && !isset($arguments['room_id'])) {

                $res[$isFinal ? 'finalRooms' : 'rooms'] = Room::query()->select('id', 'name', 'floor_id')->where($k, $v)->get();
            }

            if ($k == 'patch_panel_id' && !empty($arguments['patch_panel_id'])) {

                $excludeArray = array_merge(Distribution::query()->where($k, $v)->pluck('patch_panel_port')->toArray(), Distribution::query()->where('final_'.$k, $v)->pluck('final_patch_panel_port')->toArray());

                $res[$isFinal ? 'finalPatchPanelPorts' : 'patchPanelPorts'] = array_diff(range(1, PatchPanel::query()->find($v)->count_port), $excludeArray);
            }
        }

        $arguments = array_filter($arguments);

        if (!isset($arguments['patch_panel_id'])) {

            $res[$isFinal ? 'finalPatchPanels' : 'patchPanels'] =  PatchPanel::query()->select('id', 'name', 'count_port')->whereIn('id', Location::searchIdArray($arguments,'App\Models\PatchPanel'))->get();
        }

        if ((!isset($arguments['telecommunication_cabinet_id']) && !isset($arguments['patch_panel_id']))) {

            unset ($arguments['patch_panel_id']);

            $res[$isFinal ? 'finalTelecomCabinets' : 'telecomCabinets'] = TelecommunicationCabinet::query()->select('id', 'name')->whereIn('id', Location::searchIdArray($arguments, 'App\Models\TelecommunicationCabinet'))->get();
        }

        return $res;
    }

    public function connection(Request $request)
    {

        return $request->all();

        $res['distributions2'] = DistributionResource::collection($distributions2 = Distribution::with(['patchPanel', 'finalPatchPanel', 'location'])->whereIn('id', FinalLocation::searchIdArray($arguments, 'App\Models\Distribution', $isNull))->get());

        $searchIdArray = $distributions2->map(function ($distribution) {
            return $distribution->location->only(['building_id', 'floor_id', 'room_id', 'telecommunication_cabinet_id']);
        })->unique()->values()->all();

        foreach($searchIdArray as $v) {

            $res['equipments2'][] = NetworkEquipmentResource::collection(NetworkEquipment::with('referenceNetworkEquipment')->whereIn('id', location::searchIdArray($v, 'App\Models\NetworkEquipment'))->get());
        }


        $res['telecommunicationCabinet'] = $distributions2->map(function ($distributions2) {
            return $distributions2->location->telecommunicationCabinet->only(['id', 'name']);;
        })->unique()->values()->all();
    }
}


