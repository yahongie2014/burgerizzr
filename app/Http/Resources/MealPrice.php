<?php

namespace App\Http\Resources;

use App\Potato;
use App\PotatoesMeal;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MealPrice extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $meal = PotatoesMeal::select('*')
            ->leftjoin('potatoes','potatoes.id','PotatoesMeal.potatoes_id')
            ->leftjoin('meal_price','meal_price.id','PotatoesMeal.meal_type')
            ->where('PotatoesMeal.meal_type',$this->id)
            ->where('PotatoesMeal.meal_price_id',$this->id)
            ->select('potatoes.size','potatoes.type','potatoes.calories','potatoes.price','potatoes.id',"potatoes.cover_img")
            ->get();

        //dd($meal);
        return [
            "Identifier" =>$this->id,
            "Size" => $this->size,
            "Image" => url(Storage::url($this->image)),
            "Price" => $this->price,
           // "Potatoes" => Potetos::collection(Potato::with('meal')->get())
            "Potatoes" => Potetos::collection($meal)
        ];
    }
}
