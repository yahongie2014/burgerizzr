<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MealGift extends JsonResource
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
            "Description" => $this->description,
            "Calories" => $this->calories,
            "CoverImg" => url(Storage::url($this->cover_img)),
            "MainImage" => url(Storage::url($this->main_image)),
        ];
    }
}
