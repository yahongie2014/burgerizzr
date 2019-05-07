<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\UserValdation;
use App\Notification;
use App\Point;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;

class AuthController extends Controller
{
    public function __construct(User $user, Address $address)
    {
        $this->user = $user;
        $this->address = $address;
    }

    //old Register
    public function signup(UserValdation $request)
    {
        $genCode = rand(14544, 12124);
        $user = new $this->user($request->all());
        $user->v_code = $genCode;
        $user->password = bcrypt($request->password);
        if ($request->file('avatar')) {
            $image = $request->file('avatar');
            $name_cover = $image->getClientOriginalName();
            $ext_cover = $image->getClientOriginalExtension();
            $avatar = Storage::putFileAs('/public/Avatar', $image, $name_cover);
            $user->avatar = $name_cover;
        }
        if ($user->save()) {
            $send = $this->SendSms("$user->phone", __("general.php.php.welcome_message") . "$user->v_code");

            if ($request->address && $request->notes) {
                $client_address = new $this->address();
                $client_address->address = $request->address;
                $client_address->user_id = $user->id;
                $client_address->notes = $request->notes;
                $client_address->save();
            }
        }
        DB::commit();
        $credentials = request(['phone', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();


        return response()->json([
            'message' => 'Successfully created user!',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'success' => false,
        ], 201);
    }

    public function new_signup(UserValdation $request)
    {
        $new_sign = $this->user->where("phone", $request->phone)->get();
        if (count( $new_sign ) != 0) {
            $pass_reset = rand(10000, 99999);//(6);
            $regenerate = Hash::make($pass_reset);
            $user = User::select('*')
                ->where('phone', '=', $new_sign[0]['phone'])
                ->update(['password' => $regenerate, "v_code" => $pass_reset]);
            $send = $this->SendSms("$request->phone", "Hello Dear Welcome To Burgerizzer your password : $pass_reset");
            return response()->json(['message' => 'Successfully Resend', 'success' => true]);
        } else{
            $genCode = rand(14544, 12124);
            $user = new $this->user($request->all());
            $user->v_code = $genCode;
            $user->password = Hash::make($genCode);
            if ($user->save()) {
                $send = $this->SendSms("$user->phone", "Welcome To Burgerizzr Here's  Your Activation Code & Password: $user->v_code");
            }
            DB::commit();

            $sms = $this->SendSms("$request->phone", "Hello Dear Welcome To Burgerizzer your password : $user->v_code");

            return response()->json([
                'message' => 'Successfully created user!',
                'success' => true,
            ], 201);

        }

    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required|integer',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['phone', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized',
                'error' => __("general.loginE"),
                'success' => false,

            ], 401);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $active = User::find($user->id);
        $active->verified = 1;
        $active->save();

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        if ($request->device_token) {
            $oneSignal = User::find($user->id);
            $oneSignal->device_token = $request->device_token;
            $oneSignal->save();
        }

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'message' => __("general.login"),
            'success' => true,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out',
            'success' => true
        ]);
    }

    public function confirm(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'phone' => 'required|min:10',
            'activation_code' => 'required|max:7',
        );

        $validator = \Validator::make($input, $rules);

        if ($validator->fails()) {
            $errores = $validator->errors();
            $error_string = '';
            foreach ($errores->messages() as $key => $value) {
                $error_string .= $value[0];
            }
            return response()->json(['error' => 67, 'message' => $error_string])->setStatusCode(400);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->phone != $user->phone) {
            return response()->json(['error' => 54, 'message' => 'wrong phone'])->setStatusCode(401);
        }

        if ($request->activation_code == $user->v_code) {
            $active = User::find($user->id);
            $active->verified = 1;
            $active->save();

            return [
                'message' => 'You Are Activated!'
            ];
        } else {
            return ['error' => 'Wrong Activation code!'];
        }
    }

    public function reset(Request $request)
    {
        $input = $request->all();

        $query = $request->phone;
        if ($query == null) {
            return response()->json(['error' => 'no phone found'])->setStatusCode(400);
        }
        if (!$query && $query == '')
            return response()->json(['error' => 300, 'message' => 'check your phone number please'])->setStatusCode(400);

        $pass_reset = rand(10000, 99999);//(6);

        $regenerate = Hash::make($pass_reset);

        $user = User::select('*')
            ->where('phone', '=', $query)
            ->update(['password' => $regenerate, "v_code" => $pass_reset]);

        if (!$user) {
            return response()->json(['error' => 300, 'message' => 'check your phone number please'])->setStatusCode(400);

        }
        $send = $this->SendSms("$query", "Hello Dear Welcome To Burgerizzer your password : $pass_reset");

        return response()->json(['result' => 'Successfully Resend', 'success' => true]);
    }

    public function user(Request $request)
    {
        if ($request->input()) {

            $userprofile = $this->user->find($request->user()->id);
            if ($request->name) {
                $request->validate([
                    'name' => 'required|string',
                ]);
                $userprofile->name = $request->name;
            }
            if ($request->Email) {
                $request->validate([
                    'Email' => 'required|string|email|unique:users',
                ]);
                $userprofile->email = $request->Email;
            }
            if ($request->Phone) {
                $userprofile->phone = $request->Phone;
                $generate_number = rand(1544, 100000);
                $userprofile->v_code = $generate_number;
                $userprofile->verified = 0;
                $request->user()->token()->revoke();
                $send = $this->SendSms("$request->Phone", __("general.php.php.update_profile") . "$generate_number");
            }
            if ($request->City) {
                $userprofile->city_id = $request->City;
            }
            if ($request->longitude) {
                $userprofile->longitude = $request->longitude;
            }
            if ($request->latitudes) {
                $userprofile->latitudes = $request->latitudes;
            }
            if ($request->device_token) {
                $userprofile->device_token = $request->device_token;
            }
            if ($request->Password) {
                $userprofile->password = bcrypt($request->Password);
                $request->user()->token()->revoke();
            }
            if ($request->DeactiveAccount) {
                $userprofile->blocked = $request->DeactiveAccount;
            }
            if ($request->file('avatar')) {
                $image = $request->file('avatar');
                $name_cover = $image->getClientOriginalName();
                $ext_cover = $image->getClientOriginalExtension();
                $avatar = Storage::putFileAs('/public/Avatar', $image, $name_cover);
                $userprofile->avatar = $name_cover;
            }

            $userprofile->update();

        }
        $use = $this->sendMessage(Auth::user()->device_token, __("general.profile"), Auth::user()->id);

        return response()->json(["data" => [
            "id" => $request->user()->id,
            "name" => $request->user()->name,
            "email" => $request->user()->email,
            "phone" => $request->user()->phone,
            "verified" => (boolean)$request->user()->verified,
            "longitude" => $request->user()->longitude,
            "latitudes" => $request->user()->latitudes,
            "deactivate_account" => (boolean)$request->user()->blocked,
            "avatar" => url(Storage::url('Avatar/' . $request->user()->avatar)),
            "created_in" => Carbon::today(),
        ]]);
    }

    public function getName(Request $request)
    {
        if ($request->input()) {

            $userprofile = $this->user->find($request->user()->id);
            if ($request->name) {
                $request->validate([
                    'name' => 'required|string',
                ]);
                $userprofile->name = $request->name;
            }
            if ($request->Email) {
                $request->validate([
                    'Email' => 'required|string|email|unique:users',
                ]);
                $userprofile->email = $request->Email;
            }
            if ($request->Phone) {
                $userprofile->phone = $request->Phone;
                $generate_number = rand(1544, 100000);
                $userprofile->v_code = $generate_number;
                $userprofile->verified = 0;
                $request->user()->token()->revoke();
                $send = $this->SendSms("$request->Phone", __("general.php.php.update_profile") . "$generate_number");
            }
            if ($request->City) {
                $userprofile->city_id = $request->City;
            }
            if ($request->Password) {
                $userprofile->password = bcrypt($request->Password);
                $request->user()->token()->revoke();
            }
            if ($request->longitude) {
                $userprofile->longitude = $request->longitude;
            }
            if ($request->latitudes) {
                $userprofile->latitudes = $request->latitudes;
            }
            if ($request->DeactiveAccount) {
                $userprofile->blocked = $request->DeactiveAccount;
            }
            if ($request->file('avatar')) {
                $image = $request->file('avatar');
                $name_cover = $image->getClientOriginalName();
                $ext_cover = $image->getClientOriginalExtension();
                $avatar = Storage::putFileAs('/public/Avatar', $image, $name_cover);
                $userprofile->avatar = $name_cover;
            }

            $userprofile->update();
        }
        $points = Point::where("user_id", $request->user()->id)->get();
        $count = Point::where("user_id", $request->user()->id)->count();
        if ($count == 0) {
            return response()->json(["data" => [
                "id" => $request->user()->id,
                "reedem_points" => 0,
                "name" => $request->user()->name,
                "email" => $request->user()->email,
                "phone" => $request->user()->phone,
                "verified" => (boolean)$request->user()->verified,
                "longitude" => $request->user()->longitude,
                "latitudes" => $request->user()->latitudes,
                "deactivate_account" => (boolean)$request->user()->blocked,
                "avatar" => url(Storage::url('Avatar/' . $request->user()->avatar)),
                "created_in" => Carbon::today(),
            ]]);
        } else {
            return response()->json(["data" => [
                "id" => $request->user()->id,
                "reedem_points" => $points[0]['points'],
                "name" => $request->user()->name,
                "email" => $request->user()->email,
                "phone" => $request->user()->phone,
                "verified" => (boolean)$request->user()->verified,
                "longitude" => $request->user()->longitude,
                "latitudes" => $request->user()->latitudes,
                "deactivate_account" => (boolean)$request->user()->blocked,
                "avatar" => url(Storage::url('Avatar/' . $request->user()->avatar)),
                "created_in" => Carbon::today(),
            ]]);

        }
    }

    public function notification(Request $request)
    {
        $notify = Notification::select("*")
            ->where("user_id", Auth::user()->id)
            ->update(['is_Read' => 1]);
        $notify = Notification::where("user_id", Auth::user()->id)->get();

        return response()->json(["data" => [
            "Messages" => $notify,
            "success" => true,
        ]]);

    }

}
