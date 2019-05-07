<?php

namespace App\Nova;

use App\Menu_type_translation;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use YesWeDev\Nova\Translatable\Translatable;

class MenuType extends Resource
{

    public static $group = 'Menu Type';

    public static function label() {
        return "Menu Type";
    }
    public static $searchRelations = [
        'translatable' => ['name'],
    ];

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\MenuType';

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
            Translatable::make('Name', 'name')
                ->rules('required')
                ->locales([
                'en' => 'English',
                'ar' => 'Arabic',
            ]),
            Checkboxes::make('Active','status')
                ->options([
                    1 => 'active',
                    0 => 'not active',
                ])->onlyOnIndex(),
            Select::make('Status','status')->options([
                '1' => 'Active',
                '0' => 'Disable',
            ])->onlyOnForms()
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

