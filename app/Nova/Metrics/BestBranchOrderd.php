<?php

namespace App\Nova\Metrics;

use App\Branch;
use App\Order;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class BestBranchOrderd extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->average($request, Order::class, "branch_id","branch_id");
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
        return 'best-branch-orderd';
    }
}
