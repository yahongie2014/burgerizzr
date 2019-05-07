<?php

namespace App\Http\Resources;

use App\Branch;
use Illuminate\Http\Resources\Json\JsonResource;

class AreasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "Identifier" => $this->id,
            "Area" => $this->name,
            "Longitude" => $this->longitude,
            "Latitudes" => $this->latitudes,
            "Status" => (boolean)$this->status,
            "City" => $this->cities->name,
            "Branches" =>  BranchesResource::collection(Branch::with("users")->where("area_id",$this->id)->get()),
        ];
    }
}
