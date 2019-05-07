<?php

namespace App\Http\Resources;

use App\Meal_price;
use App\Point;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Inani\LaravelNovaConfiguration\Helpers\Configuration;

class PointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $price = Meal_price::where('meal_id', $this->id)->orderBy('price')->get();
        $sum = Point::where("user_id", $request->user()->id)->get();
        $points = $price[0]['price'] * env('POINTS', '5');
            if ($sum[0]["points"] < $points["prices"][0]["price"]) {
                $points = false;
            }else{
                $points = true;
            }

        $poin = Configuration::get('POINTS');

        return [
            "Identifier" => $this->id,
            "IsLocked" => $points,
            "Name" => $this->name,
            "Type" => $this->type,
            "MainImage" => url(Storage::url($this->main_image)),
            "Calories" => $this->calories,
            "Points" => $price[0]['price'] * $poin,
        ];
    }
}
