<?php
namespace App\Services;

use App\Contracts\PlanServiceInterface;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;

class PlanService implements PlanServiceInterface
{
    public function create(array $data): Plan
    {
        return Plan::create($data);
    }

    public function update(array $data, Plan $plan): Plan
    {
        $plan->update($data);
        return $plan;
    }

    public function delete(Plan $plan): bool
    {
        return $plan->update(['deleted_at' => now()]) ? true : false;
    }
    public function selectPlans(int $userid): ?Collection
    {
        return Plan::where('user_id', $userid)
            ->where('is_active', true)
            ->where('deleted_at', null)
            ->get();
    }
}