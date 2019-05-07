<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Potetos extends JsonResource
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
            "Image" => url(Storage::url($this->cover_img)),
            "Size" => $this->size,
            "Calories" => $this->calories,
            "Type" => $this->type,
            "Price" => $this->price,

        ];
    }
}
