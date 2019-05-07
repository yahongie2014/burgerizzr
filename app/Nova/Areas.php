<?php

namespace App\Nova;

use Fourstacks\NovaCheckboxes\Checkboxes;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use YesWeDev\Nova\Translatable\Translatable;

class Areas extends Resource
{
    public static $group = 'Branches';

    public static function label() {
        return "Areas";
    }
    public static $searchRelations = [
        'translatable' => ['name'],
    ];

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Area';

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
        'id'
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
            Translatable::make('Name','name')->locales([
                'en' => 'English',
                'ar' => 'Arabic',
            ])->singleLine()->indexLocale('en')->rules('required'),
            Text::make('Latitudes',"latitudes")->hideFromIndex()->rules('required'),
            Text::make('Longitude',"longitude")->hideFromIndex()->rules('required'),
            Checkboxes::make('Active','status')
                ->rules('required')
                ->options([
                    1 => 'active',
                    0 => 'not active',
                ])->onlyOnIndex(),
            Checkboxes::make('Active','status')
                ->rules('required')
                ->options([
                    1 => 'active',
                    0 => 'not active',
                ])->onlyOnDetail(),
            Boolean::make("Status")->onlyOnForms(),
            BelongsTo::make('Assign City', 'cities', 'App\Nova\Cities')->rules('required'),


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
        return [
            (new Metrics\AreasCount())->width('1/3'),
        ];
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
