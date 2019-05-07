<?php

namespace App\Http\Resources;

use App\Area;
use Illuminate\Http\Resources\Json\JsonResource;

class CityApi extends JsonResource
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
            "CityName" => $this->name,
            "Available" => (boolean)$this->status,
            "Areas" => AreasResource::collection(Area::where("city_id",$this->id)->get()),
        ];
    }
}
