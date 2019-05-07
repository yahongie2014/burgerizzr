<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReedeemForm;
use App\Http\Resources\PointResource;
use App\Http\Resources\PointResourceLocked;
use App\Meal;
use App\Meal_point;
use App\Nova\MealPoints;
use App\Point;
use App\Redeem_checkout;
use App\Redeem_meal_username;
use App\Status_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointsController extends Controller
{
    public function __construct(Redeem_checkout $reedem, Redeem_meal_username $username, Status_order $status)
    {
        $this->reedem = $reedem;
        $this->users = $username;
        $this->status = $status;
    }

    public function index(ReedeemForm $request)
    {

        //mealItems
        $data = $request->meal_name_user;
        $array = json_decode($data, true);
        $details = collect($array);
        $final = $details['buyers'];

        $generated = rand(2222235, 8787878);

        $make = new $this->reedem($request->all());
        $make->user_id = $request->user()->id;
        $make->points = $request->points;
        $make->redeem_number = $generated;
        $make->meal_id = $request->meal_id;
        $make->branch_id = $request->branch_id;
        $make->delivery_type = $request->delivery_type;
        $make->meal_name_user = $request->meal_name_user;
        $make->order_lat = $request->order_lat;
        $make->order_long = $request->order_long;
        if ($make->save()) {
            foreach ($final as $item) {
                $order = new $this->users();
                $order->buyer_name = $item['buyer_name'];
                $order->meal_name = $item['meal_name'];
                $order->redeem_checkout_id = $make->id;
                $order->save();
            }
            $status = new $this->status($request->all());
            $status->name = __("general.status");
            $status->status_code = 1;
            $status->order_id = $make->id;
            $status->save();
        }

        DB::commit();

        $sum = Point::where("user_id", $request->user()->id)->get();


        if ($sum[0]["points"] == 0) {
            return response()->json(["success" => false, "message" => __("general.redeem")]);
        } else {
            $points = Point::findOrCreate($sum[0]["id"]);
            $points->user_id = $request->user()->id;
            $points->points =  $sum[0]["points"] - $request->points;
            $points->save();
        }

        return response()->json(["success" => true, "Redeem_Id" => $make->id, "Redeem_number" => $make->redeem_number]);


    }

    public function MealsPoint(Request $request)
    {
        return PointResourceLocked::collection(Meal_point::orderBy("points")->get());
    }
}
