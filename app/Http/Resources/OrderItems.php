<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItems extends JsonResource
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
            "Name" => $this->name,
            "Price" => $this->price,
            "Size" => $this->size,
            "Quantity" => $this->qty,
        ];
    }
}
