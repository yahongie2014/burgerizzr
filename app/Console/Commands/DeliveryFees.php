<?php

namespace App\Console\Commands;

use App\Delivery_fee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeliveryFees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delivery:fees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delivery:fees';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mytime = Carbon::now();
        $fees = Delivery_fee::all();
        if($fees[0]->type == 'fees'){
            $update = Delivery_fee::find($fees[0]->id);
            if($update->start_in == $mytime->toDateTimeString()){
                $update->type = 'free';
                $update->save();
            }elseif($update->end_in == $mytime->toDateTimeString()){
                $update->type = 'fees';
                $update->save();
            }
        }else{
            $update = Delivery_fee::find($fees[0]->id);
            if($update->start_in == $mytime->toDateTimeString()){
                $update->type = 'free';
                $update->save();
            }elseif($update->end_in == $mytime->toDateTimeString()){
                $update->type = 'fees';
                $update->save();
            }

        }
    }
}
