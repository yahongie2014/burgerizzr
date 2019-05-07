<?php

namespace App\Nova;

use Fourstacks\NovaCheckboxes\Checkboxes;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use YesWeDev\Nova\Translatable\Translatable;

class MealSpecs extends Resource
{

    public static $group = 'Meals';

    public static function label() {
        return "MealSupplement";
    }
    public static function uriKey()
    {
        return "Meal-Supplement";
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Meals_spec';

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
        'id',
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
            Translatable::make('Name', 'name')
                ->rules('required')
                ->locales([
                'en' => 'English',
                'ar' => 'Arabic',
            ])->singleLine(),
            Translatable::make('Description', 'extra_info')
                ->rules('required')
                ->locales([
                'en' => 'English',
                'ar' => 'Arabic',
            ])->trix()->hideFromIndex(),
            Select::make('Size')
                ->rules('required')
                ->options([
                's' => 'Small',
                'm' => 'Medium',
                'l' => 'Large',
                'xl' => 'X Large',
            ])->displayUsingLabels()->hideFromIndex(),
            Number::make("Calories",'calories')->sortable()->rules('required'),
            Checkboxes::make('Active','status')
                ->options([
                    1 => 'active',
                    0 => 'not active',
                ])->onlyOnIndex(),
            Checkboxes::make('Active','status')
                ->options([
                    1 => 'active',
                    0 => 'not active',
                ])->onlyOnDetail(),
            FilemanagerField::make('Cover Image','cover_img')->displayAsImage()->rules('required'),
            Boolean::make("Status")->onlyOnForms(),
            Text::make('Price')->rules('required'),


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
