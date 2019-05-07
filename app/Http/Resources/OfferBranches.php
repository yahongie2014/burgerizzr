<?php

namespace App\Http\Resources;

use App\Branch;
use App\Offer;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OfferBranches extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $offer = Branch::where("id", $this->branch_id)->get();
        foreach ($offer as $offers)

        return [
            "Identifier" => $this->id,
            "Name" => $offers->name,
            "Address" => $offers->address,
            "Delivery" => (boolean)$offers->is_delivery_status,
            "Longitude" => $offers->longitude,
            "Latitudes" => $offers->latitudes,
            "Status" => (Boolean)$offers->status,
            "Image" => url(Storage::url($offers->path)),
        ];
    }
}
