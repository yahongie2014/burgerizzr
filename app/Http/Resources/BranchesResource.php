<?php

namespace App\Http\Resources;

use App\Branches_delivery;
use App\Meal;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Boolean;

class BranchesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
//        $geocode=file_get_contents("https://maps.google.com/maps/api/geocode/json?key=AIzaSyCPqQrMzTdp0iSj0VSEUnAcUBWZpCWRruA&&address=$this->address&sensor=false");
//        $output= json_decode($geocode);
//        foreach ($output as $outputs)
        // dd($outputs[0]->geometry->location);
        return [
            "Identifier" => $this->id,
            "Name" => $this->name,
            "Address" => $this->address,
            "Delivery" => (boolean)$this->is_delivery_status,
            "Longitude" => $this->longitude,
            "Latitudes" => $this->latitudes,
            "Status" => (Boolean)$this->status,
            "Image" => url(Storage::url($this->path)),
            "DeliveryFees" => DeliveryBranches::collection(Branches_delivery::where("branch_id",$this->id)->get()),
        ];
    }
}
