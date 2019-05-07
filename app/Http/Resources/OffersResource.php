<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OffersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->type == 1){
            $type_offer = "Gift";
        }else{
            $type_offer = "Percentage";

        }
        return [
            "Identifier" => $this->id,
            "Status" => (boolean)$this->status,
            "Type" => $type_offer,
            "Image"=> url(Storage::url($this->banner)),
        ];
    }
}
