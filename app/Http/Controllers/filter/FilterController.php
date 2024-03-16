<?php

namespace App\Http\Controllers\filter;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\DistributionResource;
use App\Http\Resources\NetworkEquipmentPortResource;
use App\Http\Resources\NetworkEquipmentResource;
use App\Models\Device;
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

        $arguments = [];
        $isNull = [];

        $request->building_id ? $arguments['building_id'] = $request->building_id : '';
        $request->floor_id ? $arguments['floor_id'] = $request->floor_id : $isNull[] = 'floor_id';
        $request->room_id ? $arguments['room_id'] = $request->room_id :$isNull[] = 'room_id';
        $request->telecommunication_cabinet_id ? $arguments['telecommunication_cabinet_id'] = $request->telecommunication_cabinet_id : $isNull[] = 'telecommunication_cabinet_id';
        $distributionsTelecomCabinetId = $request->distributionsTelecomCabinetId;
        $distributionsPatchPanelId = $request->distributionsPatchPanelId;
        $distributionsNetworkEquipmentId = $request->distributionsNetworkEquipmentId;
        $subscriberDevicesId = $request->subscriberDevicesId;

        if ($request->buttonClick == 'true') {

            $subscriberDevicesId = null;
            $distributionsTelecomCabinetId = null;
            $distributionsPatchPanelId = null;
            $distributionsNetworkEquipmentId = null;
        }
     
        if (!empty($request->subscriberId) && empty($subscriberDevicesId)) {

            $res['subscriberDevices'] = DeviceResource::collection(Device::with('referenceDevice')->whereIn('id', location::searchIdArray($arguments, 'App\Models\Device', $isNull))->where('subscriber_id', $request->subscriberId)->get());
        }

        $res['distributions'] = DistributionResource::collection($distributions = Distribution::with(['patchPanel', 'finalPatchPanel', 'location'])->whereIn('id', FinalLocation::searchIdArray($arguments, 'App\Models\Distribution', $isNull))->when($distributionsPatchPanelId !== null, function ($query) use ($distributionsPatchPanelId) {
            
            $query->where('patch_panel_id', $distributionsPatchPanelId);
        })->whereHas('location.telecommunicationCabinet', function ($query) use ($distributionsTelecomCabinetId) {
            
            $query->when($distributionsTelecomCabinetId !== null, function ($query) use ($distributionsTelecomCabinetId) {
                $query->where('id', $distributionsTelecomCabinetId);
            });
        })->get());

        $searchIdArray = $distributions->map(function ($distribution) {
            return $distribution->location->only(['building_id', 'floor_id', 'room_id', 'telecommunication_cabinet_id']);
        })->unique()->values()->all();

        if (empty($distributionsNetworkEquipmentId) && !empty($distributionsTelecomCabinetId)) {

            $res['distributionsNetworkEquipments'] = collect($searchIdArray)->map(function ($locationData) use ($distributionsTelecomCabinetId) {
                return NetworkEquipment::with('referenceNetworkEquipment')->whereIn('id', Location::searchIdArray($locationData, 'App\Models\NetworkEquipment'))->whereHas('location.telecommunicationCabinet', function ($query) use ($distributionsTelecomCabinetId) {
                
                    $query->when($distributionsTelecomCabinetId !== null, function ($query) use ($distributionsTelecomCabinetId) {
                        $query->where('id', $distributionsTelecomCabinetId);
                    });
                })->get();
            })->collapse()->map(function ($networkEquipment) {
                return new NetworkEquipmentResource($networkEquipment);
            });
        }

        $res['distributionsNetworkEquipmentPorts'] = collect($searchIdArray)->map(function ($locationData) use ($distributionsTelecomCabinetId, $distributionsNetworkEquipmentId) {
            return NetworkEquipment::with(['referenceNetworkEquipment', 'referenceNetworkEquipment.networkEquipmentPorts'])->whereIn('id', location::searchIdArray($locationData, 'App\Models\NetworkEquipment'))->when($distributionsNetworkEquipmentId !== null, function ($query) use ($distributionsNetworkEquipmentId) {
            
                $query->where('id', $distributionsNetworkEquipmentId);
            })->whereHas('location.telecommunicationCabinet', function ($query) use ($distributionsTelecomCabinetId) {
            
                $query->when($distributionsTelecomCabinetId !== null, function ($query) use ($distributionsTelecomCabinetId) {
                    $query->where('id', $distributionsTelecomCabinetId);
                });
            })->get();
        })->collapse()->map(function ($networkEquipment) {
            return new NetworkEquipmentPortResource($networkEquipment);
        });

        $res['connectionNetworkEquipmentPorts'] = NetworkEquipmentPortResource::collection(NetworkEquipment::with(['referenceNetworkEquipment', 'referenceNetworkEquipment.networkEquipmentPorts'])->whereIn('id', location::searchIdArray($arguments, 'App\Models\NetworkEquipment', $isNull))->when($distributionsNetworkEquipmentId !== null, function ($query) use ($distributionsNetworkEquipmentId) {
            
            $query->where('id', $distributionsNetworkEquipmentId);
        })->get());
        
        if(empty($distributionsTelecomCabinetId)) {

            $res['distributionsTelecomCabinets'] = $distributions->map(function ($distributions) {
                return $distributions->location->telecommunicationCabinet->only(['id', 'name']);;
            })->unique()->values()->all();
        }

        if(empty($distributionsPatchPanelId) && !empty($distributionsTelecomCabinetId)) {

            $res['distributionsPatchPanels'] = $distributions->map(function ($distributions) {
                return $distributions->patchPanel->only(['id', 'name']);;
            })->unique()->values()->all();
        }

        return $res;
    }
}


