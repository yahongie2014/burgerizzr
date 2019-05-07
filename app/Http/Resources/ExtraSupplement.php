<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ExtraSupplement extends JsonResource
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
            "Name" => $this->name,
            "Image" => url(Storage::url($this->cover_img)),
            "Description" => $this->extra_info,
            "Size" => $this->size,
            "Calories" => $this->calories,
            "Status" => (boolean)$this->status,
            "Price" => $this->price,
        ];
    }
}
