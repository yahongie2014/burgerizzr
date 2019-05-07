<?php

namespace App\Http\Resources;

use App\Ingredient;
use App\Meal;
use App\Meal_drink;
use App\Meal_price;
use App\MealImg;
use App\Meals_drink_relation;
use App\Meals_spec;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Inani\LaravelNovaConfiguration\Helpers\Configuration;

class Meals extends JsonResource
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

        return[
            "Identifier" => $this->id,
            "Status" => $this->status,
            "Name" => $this->name,
            "Description" => $this->description,
            "Type" => $this->type,
            "Calories" => $this->calories,
            "CoverImg" => url(Storage::url($this->cover_img)),
            "MainImage" => url(Storage::url($this->main_image)),
            "Points" => $price[0]['price'] * $Percentage /100 * $points,
            // "Images" => ImageResource::collection(MealImg::where('meal_id',$this->id)->get()),
            "Drinks" => DrinksResource::collection(Meals_drink_relation::where('meal_id',$this->id)->get()),
            "Ingredients" => IngredientResource::collection(Ingredient::where('meal_id',$this->id)->get()),
            "ExtraSupplement" => ExtraSupplement::collection(Meals_spec::with("meal")->get()),
            "MealPriceSize" => MealPrice::collection(Meal_price::where('meal_id',$this->id)->get())
        ];
    }
}
