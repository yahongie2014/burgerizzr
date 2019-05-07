<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Resources\AreasResource;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function __construct(Area $areas)
    {
        $this->area = $areas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  AreasResource::collection($this->area->paginate());
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
                'id' => 'required|exists:area,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        }else {

            return new AreasResource($this->area->findOrFail($id));
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
}
