<?php

namespace Database\Seeders;

use App\Models\permissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'superAdmin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'employee']);

        $balanceTransferManagement = permissionGroup::create(['name' => 'Balance Transfer']);
        Permission::create(['name' => 'balance-transfers.read', 'permission_group_id' => $balanceTransferManagement->id]);
        Permission::create(['name' => 'balance-transfers.create', 'permission_group_id' => $balanceTransferManagement->id]);
        Permission::create(['name' => 'balance-transfers.edit', 'permission_group_id' => $balanceTransferManagement->id]);
        Permission::create(['name' => 'balance-transfers.delete', 'permission_group_id' => $balanceTransferManagement->id]);

        $roleManagement = permissionGroup::create(['name' => 'Roles Management']);
        Permission::create(['name' => 'roles.read', 'permission_group_id' => $roleManagement->id]);
        Permission::create(['name' => 'roles.create', 'permission_group_id' => $roleManagement->id]);
        Permission::create(['name' => 'roles.edit', 'permission_group_id' => $roleManagement->id]);
        Permission::create(['name' => 'roles.delete', 'permission_group_id' => $roleManagement->id]);

        $rewardManagement = permissionGroup::create(['name' => 'Reward Management']);
        Permission::create(['name' => 'rewards.read', 'permission_group_id' => $rewardManagement->id]);
        Permission::create(['name' => 'rewards.create', 'permission_group_id' => $rewardManagement->id]);
        Permission::create(['name' => 'rewards.edit', 'permission_group_id' => $rewardManagement->id]);
        Permission::create(['name' => 'rewards.delete', 'permission_group_id' => $rewardManagement->id]);

        $userManagement = permissionGroup::create(['name' => 'Users Management']);
        Permission::create(['name' => 'users.read', 'permission_group_id' => $userManagement->id]);
        Permission::create(['name' => 'users.create', 'permission_group_id' => $userManagement->id]);
        Permission::create(['name' => 'users.edit', 'permission_group_id' => $userManagement->id]);
        Permission::create(['name' => 'users.delete', 'permission_group_id' => $userManagement->id]);

        $plansManagement = permissionGroup::create(['name' => 'Plans Management']);
        Permission::create(['name' => 'plans.read', 'permission_group_id' => $plansManagement->id]);
        Permission::create(['name' => 'plans.create', 'permission_group_id' => $plansManagement->id]);
        Permission::create(['name' => 'plans.edit', 'permission_group_id' => $plansManagement->id]);
        Permission::create(['name' => 'plans.delete', 'permission_group_id' => $plansManagement->id]);

        $apiClientsManagement = permissionGroup::create(['name' => 'Api Clients Management']);
        Permission::create(['name' => 'api-clients.read', 'permission_group_id' => $apiClientsManagement->id]);
        Permission::create(['name' => 'api-clients.create', 'permission_group_id' => $apiClientsManagement->id]);
        Permission::create(['name' => 'api-clients.edit', 'permission_group_id' => $apiClientsManagement->id]);
        Permission::create(['name' => 'api-clients.delete', 'permission_group_id' => $apiClientsManagement->id]);

        $superDistributorManagement = permissionGroup::create(['name' => 'Super Distributor Management']);
        Permission::create(['name' => 'super-distributors.read', 'permission_group_id' => $superDistributorManagement->id]);
        Permission::create(['name' => 'super-distributors.create', 'permission_group_id' => $superDistributorManagement->id]);
        Permission::create(['name' => 'super-distributors.edit', 'permission_group_id' => $superDistributorManagement->id]);
        Permission::create(['name' => 'super-distributors.delete', 'permission_group_id' => $superDistributorManagement->id]);

        $distributorManagement = permissionGroup::create(['name' => 'Distributor Management']);
        Permission::create(['name' => 'distributors.read', 'permission_group_id' => $distributorManagement->id]);
        Permission::create(['name' => 'distributors.create', 'permission_group_id' => $distributorManagement->id]);
        Permission::create(['name' => 'distributors.edit', 'permission_group_id' => $distributorManagement->id]);
        Permission::create(['name' => 'distributors.delete', 'permission_group_id' => $distributorManagement->id]);

        $retailerManagement = permissionGroup::create(['name' => 'Retailer Management']);
        Permission::create(['name' => 'retailers.read', 'permission_group_id' => $retailerManagement->id]);
        Permission::create(['name' => 'retailers.create', 'permission_group_id' => $retailerManagement->id]);
        Permission::create(['name' => 'retailers.edit', 'permission_group_id' => $retailerManagement->id]);
        Permission::create(['name' => 'retailers.delete', 'permission_group_id' => $retailerManagement->id]);

        $transactionManagement = permissionGroup::create(['name' => 'Transactions Management']);
        Permission::create(['name' => 'transaction.read', 'permission_group_id' => $transactionManagement->id]);

    }
}
