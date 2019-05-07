<?php

namespace App\Nova\Metrics;

use App\User;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class UsersPerPlan extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->count($request, User::class, 'verified')
            ->label(function ($value) {
                switch ($value) {
                    case 1:
                        return 'Verified';
                    case 0:
                        return 'Un Verified';
                    default:
                        return ucfirst($value);
                }
            });

    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'users-by-plan';
    }
}
