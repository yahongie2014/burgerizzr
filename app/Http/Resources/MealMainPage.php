<?php

namespace App\Http\Resources;

use App\Meal;
use App\Meal_price;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Inani\LaravelNovaConfiguration\Helpers\Configuration;

class MealMainPage extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $price = Meal_price::where('meal_id',$this->id)->orderBy('price')->get();
        $points = Configuration::get('POINTS');
        $Percentage = Configuration::get('Percentage');

        foreach ($price as $prices)
        return[
            "Identifier" => $this->id,
            "Status" => (boolean)$this->status,
            "Name" => $this->name,
            "Type" => $this->type,
            "MainImage" => url(Storage::url($this->main_image)),
            "Calories" => $this->calories,
            "MealPriceSize" => MealPrice::collection(Meal_price::where('meal_id',$this->id)->orderBy('price')->get()),
            "Points" => $prices['price'] * $Percentage /100 * $points,
        ];
    }
}
