<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistributionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,
            'distributionName' =>  $this->patch_cord_number ? "Патч корд № $this->patch_cord_number" : $this->distributionName($this->patch_panel_port, $this->patchPanel->name, $this->final_patch_panel_port ?? '', $this->finalPatchPanel->name ?? ''),
            'telecommunicationCabinetId' => $this->location->telecommunication_cabinet_id ?? false,
            'patchPanelId' => $this->patch_panel_id ?? false,
            'finalPatchPanelId' => $this->final_patch_panel_id ?? false,
        ];
    }

    public function distributionName($PatchPanelPort, $namePatchPanel, $finalPatchPanelPort, $nameFinalPatchPanel) : string
    {
        if ($nameFinalPatchPanel) {

            return "$namePatchPanel.$PatchPanelPort <--> $nameFinalPatchPanel.$finalPatchPanelPort";
        }

        return $namePatchPanel.$PatchPanelPort;
    }
}
