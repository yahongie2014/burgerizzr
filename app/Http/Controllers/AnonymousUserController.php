<?php

namespace App\Http\Controllers;

use App\Http\Requests\anonymouseValid;
use App\Un_register_user;
use Illuminate\Http\Request;

class AnonymousUserController extends Controller
{
    public function __construct(Un_register_user $non)
    {
        $this->non = $non;
    }
    public function register(anonymouseValid $request){

        $post = new $this->non($request->all());
        $post->save();
        return response()->json(["success" => true, "result" => $post]);
    }
}
