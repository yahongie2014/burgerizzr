<?php

namespace App\Providers;

use App\Policies\NoEditPolicy;
use App\Policies\OfferNogift;
use App\Policies\OfferNopercentage;
use App\Policies\OfferPloicy;
use App\Policies\ReadOnlyPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\AuthCode;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Laravel\Passport\PersonalAccessClient;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Order::class => ReadOnlyPolicy::class,
        \App\Notification::class => NoEditPolicy::class,
        \App\Redeem_checkout::class => ReadOnlyPolicy::class,
        \App\Redeem_meal_username::class => NoEditPolicy::class,
        \App\Rate::class => NoEditPolicy::class,
        \App\Address::class => NoEditPolicy::class,
        \App\Point::class => ReadOnlyPolicy::class,
        \App\Order_meal_username::class => ReadOnlyPolicy::class,
        \App\Order_item::class => ReadOnlyPolicy::class,
        \App\Delivery_fee::class => ReadOnlyPolicy::class,
        \App\Offers_product::class => OfferPloicy::class,
        \App\Offer_percentage::class => OfferPloicy::class,
    ];
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
    }
}
