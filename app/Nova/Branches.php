<?php

namespace App\Nova;

use App\City;
use Davidpiesse\Map\Map;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Naif\MapAddress\MapAddress;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use R64\NovaImageCropper\ImageCropper;

class Branches extends Resource
{

    public static $group = 'Branches';


    public static function label()
    {
        return "Branches";
    }

    public static $searchRelations = [
        'areas' => ['name'],
    ];
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Branch';

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
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make("Name")->sortable()->rules('required'),
            BelongsTo::make('Assign Area', 'areas', 'App\Nova\Areas')->rules('required'),
            HasMany::make('DeliveryFees', 'delivery', 'App\Nova\DeliveryType')->rules('required'),
            FilemanagerField::make('Image', 'path')->displayAsImage()->rules('required'),
            Text::make('Address', "address")->onlyOnDetail()->onlyOnIndex(),
            MapAddress::make('Address','address')
                ->rules('required')
                ->zoom(15)
                ->initLocation("24.734168","46.746955")
                ->zoom(12)
                ->onlyOnForms(),
            Text::make('Latitudes',"latitudes")->hideFromIndex()->sortable()->rules('required')->onlyOnForms(),
            Text::make('Longitude',"longitude")->hideFromIndex()->sortable()->rules('required')->onlyOnForms(),
            Checkboxes::make('Active', 'status')
                ->options([
                    1 => 'active',
                    0 => 'not active',
                ])->onlyOnIndex(),
            Checkboxes::make('Active', 'status')
                ->options([
                    1 => 'active',
                    0 => 'not active',
                ])->onlyOnDetail(),
            Boolean::make("Status")->onlyOnForms(),
            Boolean::make('Delivery', "is_delivery_status")->onlyOnForms(),
            HasMany::make("User", 'users', 'App\Nova\User')->hideFromIndex(),

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
        return [
            (new Metrics\BranchesCount())->width('1/3'),
        ];
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
        return [
            // new DownloadExcel,
        ];
    }
}
