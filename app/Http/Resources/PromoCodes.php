<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromoCodes extends JsonResource
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
            "Percentage" => $this->percentage."%",
            "Code" => $this->code,
            "Success" => true,
        ];
    }
}
