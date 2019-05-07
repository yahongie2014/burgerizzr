<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusOrder extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->status_code == 1){
            $status =  __("general.pending");
        }elseif ($this->status_code == 2){
            $status =  __("general.prepared");

        }elseif ($this->status_code == 3){
            $status =  __("general.in_delivery");

        }elseif($this->status_code == 4){
            $status =  __("general.deliverd");
        }

        return[
            "Identifier" => $this->id,
            "Status" => $status,
            "UpdateIn" => $this->created_at,
        ];
    }
}
