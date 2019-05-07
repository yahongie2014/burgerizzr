<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Silvanite\NovaFieldCheckboxes\Checkboxes;

class RedeemPoints extends Resource
{
    public static $group = 'Orders';

    public static function label() {
        return "Redeem Orders";
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Redeem_checkout';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'redeem_number';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'redeem_number',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make("Redeem Number","redeem_number"),
            Text::make("Redeem Points","points"),
            BelongsTo::make("BranchName",'branches','App\Nova\Branches'),
            Checkboxes::make('OrderStatus','status')
                ->options([
                    1 => 'Pending',
                    2 => 'Received',
                    3 => 'Processing',
                    4 => 'In Delivery',
                    5 => 'Delivered',
                ]),
            BelongsTo::make("UserPhone","users",'App\Nova\User'),
            HasMany::make("UserMealName","names",'App\Nova\RedeemMealNames'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
