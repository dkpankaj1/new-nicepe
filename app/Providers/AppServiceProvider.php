<?php

namespace App\Providers;

use App\Models\BalanceTransfer;
use App\Models\BrandSetting;
use App\Models\GeneralSetting;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use App\Policies\BalanceTransferPolicy;
use App\Policies\PlanPolicy;
use App\Policies\TransactionPolicy;
use App\Policies\UserPolicy;
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

        // boot policy ------------------
        Gate::policy(BalanceTransfer::class, BalanceTransferPolicy::class);
        Gate::policy(Plan::class, PlanPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Transaction::class, TransactionPolicy::class);
        // ------------------------------

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
