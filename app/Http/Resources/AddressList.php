<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            "identifier" => $this->id,
            "address" => $this->address,
            "type" => $this->type,
            "longitude" => $this->longitude,
            "latitudes" => $this->latitudes,
            "createdIn" => $this->created_at,
        ];
    }
}
