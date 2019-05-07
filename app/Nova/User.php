<?php

namespace App\Nova;

use App\Nova\Actions\NotificationUser;
use App\Nova\Metrics\NewUsers;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\FillsFields;
use Laravel\Nova\Panel;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use R64\NovaImageCropper\ImageCropper;

class User extends Resource
{
    public static $group = 'User Management';
    public static function label() {
        return "All Users";
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\User';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'phone';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'email','phone'
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
            ImageCropper::make('Avatar','avatar')
                ->preview(function () {
                    if (!$this->value) return null;
                    $url = url(Storage::url("$this->value"));
                    $filetype = pathinfo($url)['extension'];
                    return 'data:image/' . $filetype . ';base64,' . base64_encode(file_get_contents($url));
                })->onlyOnDetail(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),
            ImageCropper::make('Avatar',"avatar")
                ->preview(function () {
                    if (!$this->value) return null;
                    $url = url(Storage::url("$this->value"));
                    $filetype = pathinfo($url)['extension'];
                    return 'data:image/' . $filetype . ';base64,' . base64_encode(file_get_contents($url));
                })->onlyOnForms(),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}')->hideFromIndex(),
            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:4')
                ->updateRules('nullable', 'string', 'min:4'),
            new Panel('Extra Field', $this->Extra()),
        ];
    }

    public function Extra(){

        return [
            Text::make('Phone','phone')
                ->rules('required')
                ->sortable()
                ->updateRules('unique:users,email,{{resourceId}}'),
            BelongsTo::make('Assign Branch', 'Branch', 'App\Nova\Branches')->hideFromIndex(),
            Boolean::make("Make Admin",'is_admin')->hideFromIndex(),
            Boolean::make("Make Delivery",'is_delivery')->hideFromIndex(),
            Boolean::make('Verified','verified'),
            Boolean::make('Block','blocked'),
            Number::make("Verify Code","v_code")
                ->sortable(),
            HasMany::make("Address","Address")->hideFromIndex(),
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
            (new Metrics\NewUsers())->width('1/3'),
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
        return [
         //   new DownloadExcel,
            new NotificationUser(),
        ];
    }
}
