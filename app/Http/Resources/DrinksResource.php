<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DrinksResource extends JsonResource
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
            "Identifier" => $this->drinks->id,
            "Name" => $this->drinks->name,
            "Status" => (boolean)$this->drinks->status,
            "Calories" => $this->drinks->calories,
            "Size" => $this->drinks->size,
            "CoverImg" => url(Storage::url($this->drinks->cover_img)),
            "Price" => $this->drinks->price,
        ];
    }
}
