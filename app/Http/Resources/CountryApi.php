<?php

namespace App\Http\Resources;

use App\Cities;
use App\City;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CountryApi extends JsonResource
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
            "Name" => $this->name,
            "Flag" =>  url(Storage::url($this->flag)),
            "Cities" => CityApi::collection(City::where("country_id",$this->id)->get()),
            "Available" => $this->status,
            "KeyCode" => $this->code,
        ];
    }
}
