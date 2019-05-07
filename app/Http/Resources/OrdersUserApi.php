<?php

namespace App\Http\Resources;

use App\Order_item;
use App\Rate;
use App\Status_order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersUserApi extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->status == 1) {
            $status = __("general.pending");
        } elseif ($this->status == 2) {
            $status = __("general.prepared");

        } elseif ($this->status == 3) {
            $status = __("general.in_delivery");

        } elseif ($this->status == 4) {
            $status = __("general.deliverd");
        }

        return [
            "Identifier" => $this->id,
            "OrderNumber" => "#" . $this->order_number,
            "Rate" => RateResource::collection(Rate::where("order_id",$this->id)->get()),
            "Items" => $this->count,
            "PromoCode" => (boolean)$this->promo_code_id,
            "TotalPrice" => $this->total,
            "StatusID" => $this->status,
       //     "StatusMessage" => $status,
            "CreatedAt" => $this->created_at,
            // "OrderItems" => OrderItems::collection(Order_item::with("Orders")->where("order_id",$this->id)->get())
        ];
       $DA = StatusOrder::collection(Status_order::with("orders")->where("order_id", $this->id)->get());
    }

}
