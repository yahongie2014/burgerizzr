<?php

namespace App\Nova;

use App\Nova\Actions\AreaNotify;
use App\Nova\Actions\scheduleNotification;
use App\Nova\Actions\SendOffers;
use App\Offer;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Illuminate\Support\Facades\Storage;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Illuminate\Support\Collection;
use MichielKempen\NovaPolymorphicField\HasPolymorphicFields;
use MichielKempen\NovaPolymorphicField\PolymorphicField;

class Offers extends Resource
{
    use HasPolymorphicFields;
    public static $group = 'Campaigns';

    public static function label()
    {
        return "Offers";
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Offer';

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
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make("Offer Name", 'name')->sortable()->sortable()->rules('required'),
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
            Boolean::make("Available in Restaurant", 'restaurant')->hideFromIndex(),
            Boolean::make("Available Delivery", 'delivery')->hideFromIndex(),
            Boolean::make("Available TakeWay", 'takeaway')->hideFromIndex(),
            Select::make('Type', 'type')
                ->rules('required')
                ->options([
                    '1' => 'Gift Meal',
                    '2' => 'Percentage Offer',
                ])->displayUsingLabels()->hideFromIndex(),
            FilemanagerField::make('CoverImage', 'path')->displayAsImage()->rules('required'),
            FilemanagerField::make('BannerImage', 'banner')->displayAsImage()->rules('required'),
            DateTime::make("Start In", 'start_in')->format('DD MMM YYYY HH:I:S')->sortable()->rules('required'),
            DateTime::make("End In", 'end_in')->format('DD MMM YYYY HH:I:S')->sortable()->rules('required'),
            HasMany::make("Meals & Gift", "meals", 'App\Nova\OffersMeals'),
            HasMany::make("Meals Percentage", "meals_percentage", 'App\Nova\OfferPercentage'),
            HasMany::make("Offer Branches", "branches", 'App\Nova\OfferBranches'),
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
            new SendOffers(),
            new AreaNotify(),
            new scheduleNotification(),
        ];
    }
}
