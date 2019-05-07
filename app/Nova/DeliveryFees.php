<?php

namespace App\Nova;

use Koss\LaravelNovaSelect2\Select2;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DeliveryFees extends Resource
{
    public static $group = 'Branches';

    public static function label() {
        return 'Assign Delivery Fees';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Delivery_fee';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'start_in',
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
            Text::make("Price",'fixed_price')->sortable()->sortable()->rules('required'),
            Text::make("Offer Price",'offer_price')->sortable()->sortable()->rules('required'),
            Select::make('Type','type')
                ->rules('required')
                ->options([
                    'fees' => 'Fees',
                    'free' => 'Free',
                ])->displayUsingLabels(),
            DateTime::make("Start In",'start_in')->format('DD MMM YYYY HH:I:S')->rules('required')->hideFromIndex(),
            DateTime::make("End In",'end_in')->format('DD MMM YYYY HH:I:S')->rules('required')->hideFromIndex(),

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
