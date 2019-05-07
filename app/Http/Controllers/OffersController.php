<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferMeals;
use App\Http\Resources\OfferPercentage;
use App\Http\Resources\OffersResource;
use App\Offer;
use App\Offer_percentage;
use App\Offers_product;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function __construct(Offer $offer,Offers_product $products,Offer_percentage $percentage)
    {
        $this->offers =$offer;
        $this->products =$products;
        $this->percentage =$percentage;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OffersResource::collection($this->offers->paginate());
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:offers,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        }else {
            $find = Offer::find($id);
            if($find->type == 1){
                return OfferMeals::collection($this->products->where("offer_id",$id)->get());

            }else{
                return OfferPercentage::collection($this->percentage->where("offer_id",$id)->get());

            }
        }

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
    public function offerDetails(){
        return OfferMeals::collection($this->products->get());
    }
}
