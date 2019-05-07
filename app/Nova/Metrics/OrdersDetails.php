<?php

namespace App\Nova\Metrics;

use App\Order;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class OrdersDetails extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->count($request, Order::class, 'status')
            ->label(function ($value) {
            switch ($value) {
                case 1:
                    return 'Order Pending';
                case 2:
                    return 'Order Processing';
                case 3:
                    return 'Order Prepared';
                case 4:
                    return 'In Delivery';
                case 5:
                    return 'Delivered';

                default:
                    return ucfirst($value);
            }
        });
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
         return now()->addMinutes(1);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'orders-details';
    }
}
