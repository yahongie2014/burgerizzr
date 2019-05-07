<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Resources\AddressList;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function __construct(User $user, Address $address)
    {
        $this->user = $user;
        $this->address = $address;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $address = $this->address->where('user_id',$request->user()->id)->paginate();
//        return response()->json(["data" => [
//            "Your Address" => $address,
//            "success" => true,
//        ]]);

        return AddressList::collection($this->address->where('user_id', $request->user()->id)->paginate());

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
        $request->validate([
            'address' => 'required',
            'type' => 'required',
            'longitude' => 'required',
            'latitudes' => 'required',
        ]);

        $addr = new $this->address();
        $addr->address = $request->address;
        $addr->type = $request->type;
        $addr->longitude = $request->longitude;
        $addr->latitudes = $request->latitudes;
        $addr->user_id = $request->user()->id;
        $addr->save();

        return response()->json(["data" => [
            "message" => __("general.address"),
            "success" => true,
        ]]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:address,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $adsEdit = $this->address->findOrfail($id);
            if ($request->address) {
                $adsEdit->address = $request->address;
            }
            if ($request->type) {
                $adsEdit->type = $request->type;
            }
            if ($request->longitude) {
                $adsEdit->longitude = $request->longitude;
            }
            if ($request->latitudes) {
                $adsEdit->latitudes = $request->latitudes;
            }
            $adsEdit->update();
            return new AddressList($adsEdit);

        }

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
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:address,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $adsEdit = $this->address->findOrfail($id);
            if ($request->address) {
                $adsEdit->address = $request->address;
            }
            if ($request->type) {
                $adsEdit->type = $request->type;
            }
            if ($request->longitude) {
                $adsEdit->longitude = $request->longitude;
            }
            if ($request->latitudes) {
                $adsEdit->latitudes = $request->latitudes;
            }
            $adsEdit->update();
            return new AddressList($adsEdit);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $auth = $this->address->where('user_id', $request->user()->id);


        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:address,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $soft = $this->address->findOrFail($id);
            //  dd($soft);
            if ($request->user()->id !== $soft->user_id) {
                return response()->json(['error' => 'You can only delete your Address.', 'success' => false], 403);
            }
            $soft = $this->address->findOrFail($id);
            $soft->delete();
            DB::commit();
            return response()->json(["message" => "Address $soft->address IS Deleted", 'success' => true]);
        }
    }


    public function update_addr(Request $request, $id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:address,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $adsEdit = $this->address->findOrfail($id);
            if ($request->address) {
                $adsEdit->address = $request->address;
            }
            if ($request->type) {
                $adsEdit->type = $request->type;
            }
            if ($request->longitude) {
                $adsEdit->longitude = $request->longitude;
            }
            if ($request->latitudes) {
                $adsEdit->latitudes = $request->latitudes;
            }
            $adsEdit->update();
            return new AddressList($adsEdit);

        }

    }


}
