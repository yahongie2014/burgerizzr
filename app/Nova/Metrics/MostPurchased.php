<?php

namespace App\Nova\Metrics;

use App\Order;
use App\Order_item;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class MostPurchased extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->count($request, Order_item::class, 'item_id','item_id')
            ->label(function ($value) {
                switch ($value) {
                    case null:
                        return 'None';
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
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'most-purchased';
    }
}
