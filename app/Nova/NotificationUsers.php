<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Tests\Feature\SelectTest;
use Silvanite\NovaFieldCheckboxes\Checkboxes;
use YesWeDev\Nova\Translatable\Translatable;

class NotificationUsers extends Resource
{
    public static $group = 'Campaigns';

    public static function label() {
        return "Notifications";
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Notification';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'message';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'message',
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
            Text::make('Message', 'message')
                ->sortable()
                ->withMeta(['extraAttributes' => [
                    'readonly' => true
                ]]),
            Boolean::make('Readed','is_read')
                ->withMeta(['extraAttributes' => [
                'readonly' => true
            ]]),

            BelongsTo::make("UserPhone","users",'App\Nova\User')
                ->withMeta(['extraAttributes' => [
                'readonly' => true
            ]]),

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
