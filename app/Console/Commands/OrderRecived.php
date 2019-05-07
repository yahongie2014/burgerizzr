<?php

namespace App\Console\Commands;

use App\Notification;
use App\Order;
use App\User;
use Illuminate\Console\Command;

class OrderRecived extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:received';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'order:received';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    function sendMessage($user_notify,$message,$user,$status){
        $content = array(
            "en" => "$message"
        );

        $fields = array(
            'app_id' => env("APP_ID","0d916883-e023-41d1-96e6-b9fb535f860b"),
            'include_player_ids' => array("$user_notify"),
            'data' => array("order" => "2"),
            'contents' => $content
        );
        $notify = new Notification();
        $notify->user_id = $user;
        $notify->message = $message;
        $notify->is_read = 0;
        $notify->status = $status;
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

        return true;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orders = Order::where("status",1)->get();
        foreach ($orders as $order){
            $status = Order::find($order->id);
            $status->status = 2;
            if($status->save()){
                $users = User::where("id",$order->user_id)->get();

                foreach ($users as $user) {
                    $this->sendMessage($user->device_token,__("general.order_success"),$user->id,3);

                }
            }
        }

    }
}
