<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('distributor.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('distributor.dashboard'));
});

// wallet 
Breadcrumbs::for('distributor.wallet.index', function (BreadcrumbTrail $trail) {
    $trail->parent('distributor.dashboard');
    $trail->push('Wallet', route('distributor.wallet.index'));
});
Breadcrumbs::for('distributor.wallet.show', function (BreadcrumbTrail $trail, $transaction) {
    $trail->parent('distributor.wallet.index');
    $trail->push('Show', route('distributor.wallet.show', $transaction));
});

// recharge
Breadcrumbs::for('distributor.wallet-recharge.create', function (BreadcrumbTrail $trail) {
    $trail->parent('distributor.dashboard');
    $trail->push('Recharge', route('distributor.wallet-recharge.create'));
});


// plans::Begin
Breadcrumbs::for('distributor.plans.index', function (BreadcrumbTrail $trail) {
    $trail->parent('distributor.dashboard');
    $trail->push('Plans', route('distributor.plans.index'));
});
Breadcrumbs::for('distributor.plans.create', function (BreadcrumbTrail $trail) {
    $trail->parent('distributor.plans.index');
    $trail->push('Create', route('distributor.plans.create'));
});
Breadcrumbs::for('distributor.plans.show', function (BreadcrumbTrail $trail, $plan) {
    $trail->parent('distributor.plans.index');
    $trail->push('Create', route('distributor.plans.show', $plan));
});
Breadcrumbs::for('distributor.plans.edit', function (BreadcrumbTrail $trail, $plan) {
    $trail->parent('distributor.plans.index');
    $trail->push('Edit', route('distributor.plans.edit', $plan));
});
// plans::END


// plan
Breadcrumbs::for('distributor.myplan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('distributor.dashboard');
    $trail->push('My Plan', route('apiclient.myplan.index'));
});
Breadcrumbs::for('distributor.myplan.activation', function (BreadcrumbTrail $trail, $planDetail) {
    $trail->parent('distributor.myplan.index');
    $trail->push('Activation', route('distributor.myplan.activation', $planDetail));
});


// Account
Breadcrumbs::for('distributor.account.index', function (BreadcrumbTrail $trail) {
    $trail->parent('distributor.dashboard');
    $trail->push('Account', route('distributor.account.index'));
});
Breadcrumbs::for('distributor.account.update', function (BreadcrumbTrail $trail) {
    $trail->parent('distributor.account.index');
    $trail->push('Profile Update', route('distributor.account.update'));
});
Breadcrumbs::for('distributor.account.password', function (BreadcrumbTrail $trail) {
    $trail->parent('distributor.account.index');
    $trail->push('Change Password', route('distributor.account.password'));
});