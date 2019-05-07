<?php

namespace App\Nova;

use App\City;
use App\Countries_translation;
use Faker\Provider\Text;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use YesWeDev\Nova\Translatable\Translatable;

class Cities extends Resource
{
    public static $group = 'Branches';

    public static function label() {
        return "Cities";
    }
    public static $searchRelations = [
        'translatable' => ['name'],
    ];
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\City';

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
            ID::make()->sortable("id"),
            Translatable::make('Name','name')
                ->locales([
                'en' => 'English',
                'ar' => 'Arabic',
            ])->singleLine()->rules('required'),
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
            Boolean::make("Status")->onlyOnForms(),
            BelongsTo::make('Assign Country', 'country', 'App\Nova\Countries')->rules('required'),
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
