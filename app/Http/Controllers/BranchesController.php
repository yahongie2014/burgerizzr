<?php

namespace App\Http\Controllers;

use App\Area;
use App\Branch;
use App\Delivery_fee;
use App\Http\Resources\BranchesResource;
use function foo\func;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inani\LaravelNovaConfiguration\Helpers\Configuration;

class BranchesController extends Controller
{

    public function __construct(Branch $branches)
    {
        $this->branch = $branches;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BranchesResource::collection($this->branch->paginate());
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:branches,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {

            return new BranchesResource($this->branch->findOrFail($id));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function brancheById($id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:area,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {

            return BranchesResource::collection($this->branch->where('area_id', $id)->paginate());
        }
    }

    public function nearBy(Request $request)
    {
        $branches = Area::getByNearestLocation($request->latitude, $request->longitude);
        if (!$branches) {
            return response()->json(["success" => false, "message" => __("general.near")]);
        }

        foreach ($branches as $branch)

            return BranchesResource::collection($this->branch->where("area_id", $branch->id)->get());

    }

    public function delivery(Request $request)
    {
        $as =$this->branch->getByNearestLocation($request->latitude, $request->longitude);
        if (!$request->latitude && !$request->longitude) {
            return BranchesResource::collection($this->branch->get());
        }

        foreach ($as as $ass)

        return BranchesResource::collection($this->branch->where("id",$ass->id)->get());

    }
    public function fees(){
        $fees = Delivery_fee::all();
        if($fees[0]->type == 'fees'){
            return \response()->json(["success" => true ,"Delivery_Fees" => $fees[0]->fixed_price]);
        }else{
            return \response()->json(["success" => true ,"Delivery_Fees" => $fees[0]->offer_price]);
        }
    }



}
