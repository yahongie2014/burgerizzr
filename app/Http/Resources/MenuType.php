<?php

namespace App\Http\Resources;

use App\Meal;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuType extends JsonResource
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
            "Status" => (boolean)$this->status,
            "Name" => $this->name,
        //    "Meals" => Meals::collection(Meal::where('menu_type_id',$this->id)->get()),
        ];
    }
}
