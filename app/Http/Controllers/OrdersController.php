<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrdersUserApi;
use App\Order;
use App\Order_item;
use App\Order_meal_username;
use App\Point;
use App\Promo_code;
use App\Status_order;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;

class OrdersController extends Controller
{
    public function __construct(Order $orders, Order_item $order_items, Status_order $status, Order_meal_username $mealName)
    {
        $this->orders = $orders;
        $this->ord_item = $order_items;
        $this->status = $status;
        $this->mealUser = $mealName;
    }

    public function index(OrderRequest $request)
    {
//        if ($request->promo_id) {
//            $orders = Order::where('promo_id', $request->promo_id)->where("user_id", $request->user()->id)->get();
//            if($orders = ''){
//                return response()->json(["message" => __("general.promo"), "status" => false]);
//            }
//        }

        //mealItems
        $data = $request->data;
        $array = json_decode($data, true);
        $details = collect($array);
        $final = $details['data'];


        $make = new $this->orders($request->all());
        $generated = rand(2222235, 8787878);
        $make->user_id = $request->user()->id;
        $make->order_number = $generated;
        $make->promo_id = $request->promo_id;
        $make->count = $request->count;
        $make->points = $request->points;
        $make->order_type = $request->order_type;
        $make->meal_name_user = $request->meal_name_user;
        $make->ingrediens = $request->ingrediens;
        $make->extra = $request->extra;
        $make->total = $request->total;
        $make->branch_id = $request->branch_id;
        $make->delivery_type = $request->delivery_type;
        $make->order_lat = $request->order_lat;
        $make->order_long = $request->order_long;
        if ($make->save()) {
            foreach ($final as $item) {
                $order = new $this->ord_item();
                $order->item_id = $item['itemId'];
                $order->name = $item['name'];
                $order->size = $item['size'];
                $order->qty = 1;
                $order->type = $item['type'];
                $order->price = $item['price'];
                $order->order_id = $make->id;
                $order->save();
            }
            $meal = $request->meal_name_user;
            $array_meal = json_decode($meal, true);
            $details_meal_name = collect($array_meal);
            $final_meal = $details_meal_name['buyers'];
            foreach ($final_meal as $names) {
                $meal_ = new $this->mealUser();
                $meal_->buyer_name = $names['buyer_name'];
                $meal_->meal_name = $names['meal_name'];
                $meal_->order_id = $make->id;
                $meal_->save();
            }


            $status = new $this->status($request->all());
            $status->name = __("general.status");
            $status->status_code = 1;
            $status->order_id = $make->id;
            $status->save();

        }


        DB::commit();


        $sum = Point::where("user_id", $request->user()->id)->get();
        $count = Point::where("user_id", $request->user()->id)->count();


        if ($count == 0) {
            $points = new Point();
            $points->user_id = $request->user()->id;
            $points->points = $request->points;
            $points->save();
        } else {
            $points = Point::findOrCreate($sum[0]["id"]);
            $points->user_id = $request->user()->id;
            $points->points = $request->points + $sum[0]["points"];
            $points->save();
        }
        $order_create = $this->sendMessage(Auth::user()->device_token, __("general.order_success"), Auth::user()->id);

        return response()->json(["success" => true, "order_id" => $make->id, "order_number" => $make->order_number, "total" => $make->total]);


    }

    public
    function orders(Request $request)
    {
        return OrdersUserApi::collection($this->orders->where("user_id", $request->user()->id)
            ->where("status", 4)
            ->OrderBy("created_at", "DESC")
            ->paginate(5));
    }

    public
    function progress(Request $request)
    {
        $order_progress = $this->orders->select('*')
            ->where("user_id", $request->user()->id)
            ->orderby('created_at', 'desc')
            ->get();


        if (count($order_progress) == 0) {
            return response()->json([
                "status" => false,
                "message" => __("general.orderFail"),
            ]);
        } else {
            if ($order_progress[0]->status == 1) {
                $status = __("general.pending");
            } elseif ($order_progress[0]->status == 2) {
                $status = __("general.prepared");

            } elseif ($order_progress[0]->status == 3) {
                $status = __("general.in_delivery");

            } elseif ($order_progress[0]->status == 4) {
                $status = __("general.deliverd");
            }

            foreach ($order_progress as $statusss) {
                $branch = Branch::where('id', $order_progress[0]->branch_id)->get();
                if ($order_progress[0]->delivery_type == 1 || $order_progress[0]->delivery_type == 2) {
                    $branch_lat = $branch[0]->latitudes;
                    $branch_long = $branch[0]->longitude;
                } else {
                    $branch_lat = $statusss["order_lat"];
                    $branch_long = $statusss["order_long"];
                }
                $items = $this->ord_item->where("order_id", $statusss["id"])->count("qty");

                return response()->json([
                    "OrderNumber" => "#" . $statusss["order_number"],
                    "OrderStatusID" => $statusss["status"],
                    "OrderBranchId" => $statusss["branch_id"],
                    "OrderLong" => $branch_long,
                    "OrderLat" => $branch_lat,
                    "OrderStatusMessage" => $status,
                    "Qty" => $items,
                    "Total" => $statusss->total,
                    "Points" => $statusss->total * env("POINTS", 5),
                    "Time" => env("DELIVEYTIME", 60),
                    'ItemsNumber' => $statusss->count,
                    'Address' => "cairo",
                    'status' => true,
                ]);

            }

        }


    }
}
