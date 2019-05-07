<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
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
            "Identifier" => $this->id,
            "OrderID" => $this->orders['order_number'],
            "AverageRate" => $this->stars,
            "Notes" => $this->notes,
            "success" => true,
        ];
    }
}
