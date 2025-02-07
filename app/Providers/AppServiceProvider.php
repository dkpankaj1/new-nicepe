<?php

namespace App\Providers;

use App\Enums\UserType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        $this->registerBladeDirective();
    }

    protected function registerBladeDirective(): void
    {
        Blade::if('isAdmin', fn() => Auth::check() && Auth::user()->type === UserType::ADMIN->value);
    }
}
