<?php

namespace App\Nova;

use Fourstacks\NovaCheckboxes\Checkboxes;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use R64\NovaImageCropper\ImageCropper;

class Delivers extends Resource
{
    public static $group = 'User Management';

    public static function label() {
        return 'Assign New Drivers';
    }
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Deliverer';

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
            BelongsTo::make('Assign User', 'users', 'App\Nova\User'),
            Number::make("Vehicle ID","vehicle_id"),
            Number::make("License ID","license_id"),
        ];
    }

    public function Extra()
    {
        return [
            Text::make('Phone', 'phone')->hideFromIndex(),
            Checkboxes::make('Verified', 'verified')
                ->options([
                    1 => 'active',
                    0 => 'not active',
                ])->onlyOnDetail(),
            Boolean::make('Verified', 'verified')->onlyOnForms(),
            Checkboxes::make('Block', 'blocked')
                ->options([
                    1 => 'active',
                    0 => 'not active',
                ])->onlyOnDetail(),
            Boolean::make('Block', 'blocked')->onlyOnForms(),
            Number::make("Verify Code", "v_code"),
            Number::make('Longitude', "longitude")->hideFromIndex(),
            HasMany::make("Address", "Address")->hideFromIndex(),
            Number::make('Latitudes', "latitudes")->hideFromIndex(),
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
