<?php

namespace App\Nova;

use App\Country;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Illuminate\Support\Facades\Storage;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Panel;
use R64\NovaImageCropper\ImageCropper;
use YesWeDev\Nova\Translatable\Translatable;

class Countries extends Resource
{
    public static $group = 'Branches';

    public static function label() {
        return "Countries";
    }
    public static $searchRelations = [
        'translatable' => ['name'],
    ];

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $displayInNavigation = true;



    public static $model = Country::class;

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Translatable::make('Name','name')
                ->rules('required')
                ->locales([
                'en' => 'English',
                'ar' => 'Arabic',
            ])->singleLine(),
            FilemanagerField::make('Flag')->rules('required')->displayAsImage(),
            Number::make('Code', 'code')->rules('required'),
            new Panel('Status', $this->status()),
            ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function status(){
        return[
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
            HasMany::make("Cities","cities","App\Nova\Cities")->hideFromIndex()->rules('required'),
        ];
    }

    public function cards(Request $request)
    {
        return [

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
