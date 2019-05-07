<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryBranches extends JsonResource
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
            "TypeDelivery" => $this->type,
            "FixedPrice" => $this->fixed_price,
            "FreePrice" => $this->offer_price,
        ];
    }
}
