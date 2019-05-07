<?php

namespace App\Providers;

use App\Nova\Metrics\AreasCount;
use App\Nova\Metrics\BestBranchOrderd;
use App\Nova\Metrics\BranchesCount;
use App\Nova\Metrics\MealsCount;
use App\Nova\Metrics\MostPurchased;
use App\Nova\Metrics\NewOrders;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\OrdersDetails;
use App\Nova\Metrics\UserRates;
use App\Nova\Metrics\UsersPerPlan;
use App\Nova\User;
use Inani\LaravelNovaConfiguration\LaravelNovaConfiguration;
use Infinety\Filemanager\FilemanagerTool;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email,$user->phone [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
           // new Help,
        //    new CacheCard(),
            new UsersPerPlan(),
            new OrdersDetails(),
            new MealsCount(),
            new AreasCount(),
            new BestBranchOrderd(),
            new MostPurchased(),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new FilemanagerTool(),
          //  new CpanelMail(),
            new LaravelNovaConfiguration(),
        ];
    }

    protected function resources()
    {
        Nova::resourcesIn(app_path('Nova'));

        Nova::resources([
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->gate();
    }
}
