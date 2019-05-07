<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Illuminate\Support\Facades\Storage;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use R64\NovaImageCropper\ImageCropper;
use YesWeDev\Nova\Translatable\Translatable;

class Menus extends Resource
{

    public static $group = 'Meals';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static function label() {
        return "Meals";
    }
    public static $model = 'App\Meal';

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
            Translatable::make('Name', 'name')
                ->rules('required', 'max:254')
                ->locales([
                'en' => 'English',
                'ar' => 'Arabic',
            ])->singleLine(),
            Translatable::make('Description', 'description')
                ->rules('required', 'max:500')
                ->locales([
                'en' => 'English',
                'ar' => 'Arabic',
            ])->trix()->hideFromIndex(),
          //  PostContent::make('attribute_name')->withCarouselFields(['text', 'image', 'video', 'carousel']),
            FilemanagerField::make('CoverImage','cover_img')->displayAsImage()->rules('required'),
            FilemanagerField::make('MainImage','main_image')->displayAsImage()->rules('required'),
            new Panel('Type', $this->Size()),
            new Panel('Date', $this->ExtraInfo()),

        ];
    }
    public function Size(){
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
            BelongsTo::make('Assign Menus', 'menu', 'App\Nova\MenuType')
                ->rules('required'),
            Number::make('Calories',"calories")->sortable()->rules('required'),
            Select::make('Type','type')->options([
                'Regular' => 'Regular',
                'Large' => 'Large',
                'Combo' => 'Combo',
                ])->sortable()
                ->rules('required')
                ->displayUsingLabels()->hideFromIndex(),
        //    HasMany::make("Meal Images","images",'App\Nova\MealImg')->hideFromIndex(),
            HasMany::make("Meal Drinks","drinks",'App\Nova\MealDrinks')->hideFromIndex(),
            HasMany::make("Meal Ingredient","ingredients",'App\Nova\Ingredients')->hideFromIndex(),
            HasMany::make("Meal Prices","prices",'App\Nova\MealPrice')->hideFromIndex(),
            HasMany::make("Meal Items","items",'App\Nova\ExtraMeal')->hideFromIndex(),

        ];
    }

    public function ExtraInfo(){
        return[
            Date::make('Create In','created_at')->format('DD MMM Y h:mm')->hideWhenCreating()->hideWhenUpdating(),
            Date::make('Updated In','updated_at')->format('DD MMM Y h:mm')->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),

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
        return [
          //  new DownloadExcel,
        ];
    }
}
