<?php

namespace App\Providers;

use App\Contracts\PlanServiceInterface;
use App\Models\BrandSetting;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('superAdmin') ? true : null;
        });

        $this->registerBladeDirective();
        $this->registerViewShare();
    }

    protected function registerBladeDirective(): void
    {

    }
    protected function registerViewShare(): void
    {
        View::share('brandSetting', BrandSetting::first());
        View::share('generalSetting', GeneralSetting::first());
    }
}
