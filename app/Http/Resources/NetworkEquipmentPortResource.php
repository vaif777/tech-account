<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NetworkEquipmentPortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id ?? '',
            'name' => $this->name ?? '',
            'ipAddress' => $this->ip_address ?? '',
            'manufacturer' => $this->referenceNetworkEquipment->manufacturer ?? '',
            'model' => $this->referenceNetworkEquipment->model ?? '',
            'type' => $this->referenceNetworkEquipment->device_type ?? '',
            'ports' => PortResource::collection($this->referenceNetworkEquipment->networkEquipmentPorts),     
        ];
    }
}
