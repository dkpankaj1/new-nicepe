<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('superdistributor.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('superdistributor.dashboard'));
});

// wallet 
Breadcrumbs::for('superdistributor.wallet.index', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.dashboard');
    $trail->push('Wallet', route('superdistributor.wallet.index'));
});
Breadcrumbs::for('superdistributor.wallet.show', function (BreadcrumbTrail $trail, $transaction) {
    $trail->parent('superdistributor.wallet.index');
    $trail->push('Show', route('superdistributor.wallet.show', $transaction));
});

// recharge
Breadcrumbs::for('superdistributor.wallet-recharge.create', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.dashboard');
    $trail->push('Recharge', route('superdistributor.wallet-recharge.create'));
});

// distributors::Begin
Breadcrumbs::for('superdistributor.distributors.index', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.dashboard');
    $trail->push('Distributor', route('superdistributor.distributors.index'));
});
Breadcrumbs::for('superdistributor.distributors.create', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.distributors.index');
    $trail->push('Create', route('superdistributor.distributors.create'));
});
Breadcrumbs::for('superdistributor.distributors.show', function (BreadcrumbTrail $trail,$distributors) {
    $trail->parent('superdistributor.distributors.index');
    $trail->push('Show', route('superdistributor.distributors.show',$distributors));
});
Breadcrumbs::for('superdistributor.distributors.edit', function (BreadcrumbTrail $trail,$distributors) {
    $trail->parent('superdistributor.distributors.index');
    $trail->push('Edit', route('superdistributor.distributors.edit',$distributors));
});
// distributors::END


// plans::Begin
Breadcrumbs::for('superdistributor.plans.index', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.dashboard');
    $trail->push('Plans', route('superdistributor.plans.index'));
});
Breadcrumbs::for('superdistributor.plans.create', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.plans.index');
    $trail->push('Create', route('superdistributor.plans.create'));
});
Breadcrumbs::for('superdistributor.plans.show', function (BreadcrumbTrail $trail,$plan) {
    $trail->parent('superdistributor.plans.index');
    $trail->push('Show', route('superdistributor.plans.show',$plan));
});
Breadcrumbs::for('superdistributor.plans.edit', function (BreadcrumbTrail $trail,$plan) {
    $trail->parent('superdistributor.plans.index');
    $trail->push('Edit', route('superdistributor.plans.edit',$plan));
});
// plans::END

// retailers::Begin
Breadcrumbs::for('superdistributor.retailers.index', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.dashboard');
    $trail->push('Retailer', route('superdistributor.retailers.index'));
});
Breadcrumbs::for('superdistributor.retailers.create', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.retailers.index');
    $trail->push('Create', route('superdistributor.retailers.create'));
});
Breadcrumbs::for('superdistributor.retailers.show', function (BreadcrumbTrail $trail,$retailers) {
    $trail->parent('superdistributor.retailers.index');
    $trail->push('Show', route('superdistributor.retailers.show',$retailers));
});
Breadcrumbs::for('superdistributor.retailers.edit', function (BreadcrumbTrail $trail,$retailers) {
    $trail->parent('superdistributor.retailers.index');
    $trail->push('Edit', route('superdistributor.retailers.edit',$retailers));
});
// retailers::END

// my-plan
Breadcrumbs::for('superdistributor.myplan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.dashboard');
    $trail->push('My Plan', route('superdistributor.myplan.index'));
});
Breadcrumbs::for('superdistributor.myplan.activation', function (BreadcrumbTrail $trail, $planDetail) {
    $trail->parent('superdistributor.myplan.index');
    $trail->push('Activation', route('superdistributor.myplan.activation', $planDetail));
});


// Account
Breadcrumbs::for('superdistributor.account.index', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.dashboard');
    $trail->push('Account', route('superdistributor.account.index'));
});
Breadcrumbs::for('superdistributor.account.update', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.account.index');
    $trail->push('Profile Update', route('superdistributor.account.update'));
});
Breadcrumbs::for('superdistributor.account.password', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.account.index');
    $trail->push('Change Password', route('superdistributor.account.password'));
});