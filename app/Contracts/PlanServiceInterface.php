<?php
namespace App\Contracts;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;

interface PlanServiceInterface
{
    public function create(array $data): Plan;
    public function update(array $data, Plan $plan): Plan;
    public function delete(Plan $plan): bool;
    public function selectPlans(int $id): ?Collection;

}
