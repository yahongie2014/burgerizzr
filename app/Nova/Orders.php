<?php

namespace App\Nova;

use App\Nova\Actions\AcceptOrder;
use App\Nova\Actions\DeliveredOrder;
use App\Nova\Actions\InDelivery;
use App\Nova\Actions\ProcessOrder;
use App\Order;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Silvanite\NovaFieldCheckboxes\Checkboxes;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Naif\MapAddress\MapAddress;

class Orders extends Resource
{

    protected $showCrateForm = false;

    public static $group = 'Orders';

    public static function create(Orders $orders)
    {
        return false;
    }
    public static function searchable()
    {
        return true;
    }
    public static function label() {
        return "Orders";
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Order';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'order_number';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'order_number',
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
            Text::make('Order Number','order_number')->sortable()
                ->withMeta(['extraAttributes' => [
                'readonly' => true
            ]]),
            BelongsTo::make("BranchName",'branches','App\Nova\Branches')
                ->withMeta(['extraAttributes' => [
                'readonly' => true
            ]])->hideWhenUpdating(),
            Checkboxes::make('OrderStatus','status')
                ->options([
                    1 => 'Pending',
                    2 => 'Received',
                    3 => 'Processing',
                    4 => 'In Delivery',
                    5 => 'Delivered',
                ]),
            Checkboxes::make('OrderType','order_type')
                ->options([
                  1 => "RegularOrder",
                  2 => "OfferGiftMeal",
                  3 => "OfferPercentageMeal",
                ]),
            HasMany::make("Orders Users","order_items",'App\Nova\OrderItems')->hideFromIndex()
                ->withMeta(['extraAttributes' => [
                    'readonly' => true
                ]])->hideWhenUpdating(),
            HasMany::make("Users Meal","order_users",'App\Nova\UserMeals')->hideFromIndex()
                ->withMeta(['extraAttributes' => [
                    'readonly' => true
                ]])->hideWhenUpdating(),

            BelongsTo::make("PromoCode",'promo','App\Nova\PromoCodes')
                ->withMeta(['extraAttributes' => [
                'readonly' => true
            ]])->hideWhenUpdating(),
            Text::make("Total","total")
                ->withMeta(['extraAttributes' => [
                    'readonly' => true
                ]]),
            Date::make("Created In","created_at")
                ->withMeta(['extraAttributes' => [
                    'readonly' => true
                ]])->hideWhenUpdating(),
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
            (new Metrics\NewOrders())->width('1/3'),

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
            new AcceptOrder(),
            new ProcessOrder(),
            new InDelivery(),
            new DeliveredOrder(),

        ];
    }
}
