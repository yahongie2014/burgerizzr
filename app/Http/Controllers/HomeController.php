<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Berkayk\OneSignal\OneSignalClient as OneSignal;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function notify(Request $request){
        $dump = $this->sendMessage("$request->id","Hello Mr Ahmed");
        return response()->json(['response' => $dump,"success" => true]);
    }
}
