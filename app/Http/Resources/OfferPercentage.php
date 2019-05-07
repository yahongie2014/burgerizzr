<?php

namespace App\Http\Resources;

use App\Branch;
use App\Meal;
use App\Offer;
use App\Offer_branch;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OfferPercentage extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $offer = Offer::where("id", $this->offer_id)->get();
        foreach ($offer as $offers)
            if ($offers->type == 1) {
                $type_offer = "Gift";
            } else {
                $type_offer = "Percentage";

            }
            return [
                "Identifier" => $offers->id,
                "OfferName" => $offers->name,
                "OfferType" => $type_offer,
                "is_restaurant" => (boolean)$offers->restaurant,
                "is_delivery" => (boolean)$offers->delivery,
                "is_takeaway" => (boolean)$offers->takeaway,
                "OfferImg" => url(Storage::url($offers->path)),
                "OfferStatus" => (boolean)$offers->status,
                "OfferMeal" => Meals::collection(Meal::where('id', $this->meal_id)->get()),
                "Percentage" => $this->percentage,
                "OfferAvailableInBranches" => OfferBranches::collection(Offer_branch::where('offer_id', $this->offer_id)->get()),
            ];

    }
}
