<?php

namespace App\Console;

use App\Console\Commands\DeliveryFees;
use App\Console\Commands\OrderInDelivery;
use App\Console\Commands\OrderPerpeared;
use App\Console\Commands\OrderRecived;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\OrderRecived',
        'App\Console\Commands\OrderPerpeared',
        'App\Console\Commands\OrderInDelivery',
        ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new OrderRecived(),'order:received')->daily()->everyTenMinutes();
        $schedule->job(new OrderPerpeared(),'order:peppered')->daily()->everyTenMinutes();
        $schedule->job(new OrderInDelivery(),'order:delivery')->daily()->everyTenMinutes();
        $schedule->job(new DeliveryFees(),'delivery:fees')->daily()->everyTenMinutes();

        $schedule->command('order:received')->daily()->everyTenMinutes();
        $schedule->command('order:peppered')->daily()->everyTenMinutes();
        $schedule->command('order:delivery')->daily()->everyTenMinutes();
        $schedule->command('delivery:fees')->daily()->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
