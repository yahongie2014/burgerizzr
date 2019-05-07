<?php

namespace App\Http\Controllers;

use App\Notification;
use Curl;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function SendSms($phone ,$message)
    {
        $data = array(
            "Username" => "966564545797",
            "Password" => "123456789",
            "Tagname" => "Hykaia",
            "RecepientNumber" => $phone,
            "VariableList" => "[Name]",
            "ReplacementList" => "Ahmed,9000",
            "Message" => $message,
            "SendDateTime" => 0,
            " EnableDR" => true
        );
        $data_string = json_encode($data);

        $ch = curl_init('http://api.yamamah.com/SendSMS');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);
        if ($result === FALSE) {
            Log::error('Curl failed: ' . curl_error($ch));
        }
        else{
            //echo $result;
            Log::info($result);
        }

        return true;

    }


    function sendMessage($user_notify,$message,$user){
        $content = array(
            "en" => "$message"
        );
        $data =array("order" => "1");
        $fields = array(
            'app_id' => env("APP_ID","0d916883-e023-41d1-96e6-b9fb535f860b"),
            'include_player_ids' => array("$user_notify"),
            'data' => $data,
            'contents' => $content
        );
        $notify = new Notification();
        $notify->user_id = $user;
        $notify->message = $message;
        $notify->is_read = 0;
        $notify->status = 1;
        $notify->save();

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);

     //   dd($response);
        return true;
    }

}
