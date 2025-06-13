<?php

namespace App\Providers;

use App\Features\AadharEmailUpdateFeature;
use App\Features\AadharMobileEmailUpdateFeature;
use App\Features\AadharMobileUpdateFeature;
use App\Features\BirthCertificateFeature;
use App\Features\CovidCertificateFeature;
use App\Features\EidToPdfFeature;
use App\Features\MobileRechargeFeature;
use App\Features\NsdlPanApplicationFeature;
use App\Features\PanFindWithAadharFeature;
use App\Models\BalanceTransfer;
use App\Models\BrandSetting;
use App\Models\GeneralSetting;
use App\Models\Plan;
use App\Models\PlanDetail;
use App\Models\Transaction;
use App\Models\User;
use App\Policies\BalanceTransferPolicy;
use App\Policies\PlanDetailPolicy;
use App\Policies\PlanPolicy;
use App\Policies\TransactionPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Exception;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        try {
            Blade::if('featureEnabled', function () {
                return false;
            });
        } catch (Exception $e) {
            Log::error('Failed to register Blade directive: ' . $e->getMessage());
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            // boot policy ------------------
            Gate::policy(BalanceTransfer::class, BalanceTransferPolicy::class);
            Gate::policy(Plan::class, PlanPolicy::class);
            Gate::policy(PlanDetail::class, PlanDetailPolicy::class);
            Gate::policy(User::class, UserPolicy::class);
            Gate::policy(Transaction::class, TransactionPolicy::class);
            // ------------------------------

            Gate::before(function ($user, $ability) {
                return $user->hasRole('superAdmin') ? true : null;
            });

            $this->registerBladeDirective();
            $this->registerViewShare();
        } catch (Exception $e) {
            Log::error('Error in AppServiceProvider boot: ' . $e->getMessage());
        }
    }

    protected function registerBladeDirective(): void
    {
        $features = [
            'aadharEmailUpdateFeatureEnabled' => AadharEmailUpdateFeature::class,
            'aadharMobileUpdateFeatureEnabled' => AadharMobileUpdateFeature::class,
            'aadharMobileEmailUpdateFeatureEnabled' => AadharMobileEmailUpdateFeature::class,
            'birthCertificateFeatureEnabled' => BirthCertificateFeature::class,
            'covidCertificateFeatureEnabled' => CovidCertificateFeature::class,
            'eidToPdfFeatureEnabled' => EidToPdfFeature::class,
            'mobileRechargeFeatureEnabled' => MobileRechargeFeature::class,
            'nsdlPanApplicationFeatureEnabled' => NsdlPanApplicationFeature::class,
            'panFindWithAadharFeatureEnabled' => PanFindWithAadharFeature::class,
        ];

        foreach ($features as $directive => $featureClass) {
            try {
                Blade::if($directive, function () use ($featureClass) {
                    try {
                        return $featureClass::isEnableForUser();
                    } catch (Exception $e) {
                        Log::error("Error checking feature {$featureClass}: " . $e->getMessage());
                        return false;
                    }
                });
            } catch (Exception $e) {
                Log::error("Error registering Blade directive {$directive}: " . $e->getMessage());
            }
        }

        // Register directive for multiple features
        try {
            Blade::if('anyFeatureEnabled', function (...$directives) use ($features) {
                foreach ($directives as $directive) {
                    try {
                        if (isset($features[$directive]) && $features[$directive]::isEnableForUser()) {
                            return true;
                        }
                    } catch (Exception $e) {
                        Log::error("Error checking feature in anyFeatureEnabled {$directive}: " . $e->getMessage());
                    }
                }
                return false;
            });
        } catch (Exception $e) {
            Log::error('Error registering anyFeatureEnabled directive: ' . $e->getMessage());
        }
    }

    protected function registerViewShare(): void
    {
        try {
            View::share('brandSetting', BrandSetting::first());
            View::share('generalSetting', GeneralSetting::first());
        } catch (Exception $e) {
            Log::error('Error sharing view data: ' . $e->getMessage());
            // Share null values to prevent undefined variable errors
            View::share('brandSetting', null);
            View::share('generalSetting', null);
        }
    }
}