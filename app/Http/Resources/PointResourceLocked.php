<?php

namespace App\Http\Resources;

use App\Meal;
use App\Meal_price;
use App\Point;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PointResourceLocked extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $sum = Point::where("user_id", $request->user()->id)->get();
        if ($sum[0]["points"] < $this->points) {
            $points = true;
        }else{
            $points = false;
        }

        return [
            "Identifier" => $this->meal->id,
            "IsLocked" => $points,
            "Name" => $this->meal->name,
            "Type" => $this->meal->type,
            "MainImage" => url(Storage::url($this->meal->main_image)),
            "Calories" => $this->meal->calories,
            "Points" => $this->points,
        ];
    }
}
