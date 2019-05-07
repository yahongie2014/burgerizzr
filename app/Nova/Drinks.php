<?php

namespace App\Nova;

use Illuminate\Support\Facades\Storage;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use R64\NovaImageCropper\ImageCropper;

class Drinks extends Resource
{

    public static $group = 'Meals';

    public static $displayInNavigation = true;

    public static function label() {
        return "Drinks";
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Meal_drink';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
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
            Text::make("Name",'name')->rules('required'),
            Boolean::make("Status"),
            Select::make('Size')
                ->rules('required')
                ->options([
                's' => 'Small',
                'm' => 'Medium',
                'l' => 'Large',
                'xl' => 'X Large',
            ])->displayUsingLabels()->hideFromIndex(),
            FilemanagerField::make('Cover Image','cover_img')->displayAsImage()->rules('required'),
            Number::make('Calories',"calories")->sortable()->rules('required'),
            Text::make('Price',"price")->sortable()->onlyOnDetail(),
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
