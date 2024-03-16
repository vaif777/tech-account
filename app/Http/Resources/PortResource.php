<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'from' => $this->from ?? '',
            'before' => $this->before ?? '',
            'bandwidth' => $this->bandwidth ?? '',
            'connectionInterfaces' => $this->connection_interfaces ?? '',
            'portFunctionality' => $this->port_functionality ?? '',
            'networkArchitecturePort' => $this->network_architecture_port ?? '',
            'power' => $this->power ?? '',   
        ];
    }
}
