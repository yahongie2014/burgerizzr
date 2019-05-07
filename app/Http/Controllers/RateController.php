<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatesForm;
use App\Http\Resources\RateResource;
use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{

    public function __construct(Rate $rates)
    {
        $this->rates = $rates;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return RateResource::collection($this->rates->where("user_id",$request->user()->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RatesForm $request)
    {
        $validator = \Validator::make(
            ['order_id' => $request->order_id],
            array(
                'order_id' => 'required|exists:orders,id|integer',
            ),
            [
                'order_id' => __("validation.required"),
            ]
        );
        if($validator->fails()) {
            return response()->json(["success" => "false", 'errors' => 'Nor Order id Like That'])->setStatusCode(400);
        }else {

            $count = $this->rates->where('order_id', '=', $request->order_id)->where('user_id', '=', $request->user()->id)->count();
            if ($count) {
                return response()->json(["success" => "false", 'errors' => 'you Already Rate That Order'])->setStatusCode(400);
            }

            $rates = new Rate();
            $rates->user_id = $request->user()->id;
            $rates->order_id = $request->order_id;
            $rates->branch_id = $request->branch_id;
            $rates->stars = $request->stars;
            $rates->notes = $request->notes;
            $rates->save();
            DB::commit();
            return RateResource::collection($this->rates->where("id", $rates->id)->get());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
