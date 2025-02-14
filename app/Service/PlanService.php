<?php
namespace App\Service;

use App\Contracts\PlanServiceInterface;
use App\Models\Plan;

class PlanService implements PlanServiceInterface
{
    public function create(array $data): Plan
    {
        return Plan::create($data);
    }

    public function update(array $data, Plan $plan): Plan
    {
        return $plan;
    }

    public function delete(Plan $plan): bool
    {
        return true;
    }
}