<?php

namespace App\Nova;

use Illuminate\Support\Facades\Storage;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use R64\NovaImageCropper\ImageCropper;

class MealPrice extends Resource
{

    public static $group = 'Meals';

    public static $displayInNavigation = true;

    public static function label() {
        return "Meal Prices";
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Meal_price';

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
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Select::make('Size')->options([
                's' => 'Small',
                'm' => 'Medium',
                'l' => 'Large',
                'xl' => 'X Large',
            ])->rules('required'),
            FilemanagerField::make('Image','image')->displayAsImage()->rules('required'),
            BelongsTo::make('Assign Meal', 'meals', 'App\Nova\Menus')
                ->rules('required'),
            Text::make('Price','price')->rules('required'),
            HasMany::make("Meal Potatoes","meal",'App\Nova\ExtraPotetos')->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
