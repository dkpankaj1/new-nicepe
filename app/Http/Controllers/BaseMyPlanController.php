<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\PlanDetail;
use App\Models\User;
use App\Services\FeatureActivationService;
use App\Services\ToasterService;
use App\Services\TransactionService;
use App\Services\UserPlanService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class BaseMyPlanController extends Controller
{
    protected array $routes;
    protected array $breadcrumbs;

    public function __construct()
    {
        $this->setRoutes();
        $this->setBreadcrumbs();
    }

    /**
     * Define routes in child class.
     */
    abstract protected function setRoutes(): void;

    /**
     * Define breadcrumbs in child class.
     */
    abstract protected function setBreadcrumbs(): void;

    public function index()
    {
        $userPlanService = new UserPlanService(Auth::id());
        return view('shared.userplan.index', [
            'plan' => $userPlanService->plans(),
            'breadcrumb' => Breadcrumbs::render($this->breadcrumbs['index']),
            'activationRoute' => $this->routes['activation']
        ]);
    }

    public function activation(PlanDetail $planDetail)
    {
        try {
            $featureActivationService = $this->getFeatureActivationService($planDetail);

            if (!$featureActivationService->hasFeature()) {
                throw new Exception("Feature not in user plan.");
            }

            if ($featureActivationService->isFeatureAlreadyActivated()) {
                throw new Exception("Feature already activated for this user.");
            }

            return view('shared.plan-activation', [
                'planDetails' => $planDetail,
                'breadcrumb' => Breadcrumbs::render($this->breadcrumbs['activation'], $planDetail),
                'action' => route($this->routes['activation'], $planDetail)
            ]);
        } catch (Exception $e) {
            ToasterService::error($e->getMessage());
            return redirect()->route($this->routes['index']);
        }
    }

    public function processActivation(Request $request, PlanDetail $planDetail)
    {
        try {
            $featureActivationService = $this->getFeatureActivationService($planDetail);

            if (!$featureActivationService->hasFeature()) {
                throw new Exception("Feature not in user plan.");
            }

            if ($featureActivationService->isFeatureAlreadyActivated()) {
                throw new Exception("Feature already activated for this user.");
            }

            $featureActivationService->activate();

            ToasterService::success(__('message.success.default'));
            return redirect()->route($this->routes['index']);
        } catch (Exception $e) {
            ToasterService::error($e->getMessage());
            return redirect()->route($this->routes['index']);
        }
    }

    private function getFeatureActivationService(PlanDetail $planDetail): FeatureActivationService
    {
        return new FeatureActivationService(
            User::find(Auth::id()),
            Feature::where('id',$planDetail->feature_id)->first(),
            new TransactionService()
        );
    }
}
