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
        return $plan->delete() ? true : false;
    }
    public function selectPlans(int $userid): ?Collection
    {
        return Plan::where('user_id', $userid)->get();
    }
}