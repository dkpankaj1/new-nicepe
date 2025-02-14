<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


// Dashboard
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});


// Account
Breadcrumbs::for('admin.account.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Account', route('admin.account.index'));
});
Breadcrumbs::for('admin.account.update', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.account.index');
    $trail->push('Profile Update', route('admin.account.update'));
});
Breadcrumbs::for('admin.account.password', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.account.index');
    $trail->push('Change Password', route('admin.account.password'));
});


// Plans
Breadcrumbs::for('admin.plans.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Plans', route('admin.plans.index'));
});
Breadcrumbs::for('admin.plans.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.plans.index');
    $trail->push('Create', route('admin.plans.create'));
});
Breadcrumbs::for('admin.plans.edit', function (BreadcrumbTrail $trail, $plan) {
    $trail->parent('admin.plans.index');
    $trail->push('Edit', route('admin.plans.edit', $plan));
});
Breadcrumbs::for('admin.plans.show', function (BreadcrumbTrail $trail, $plan) {
    $trail->parent('admin.plans.index');
    $trail->push('Show', route('admin.plans.show', $plan));
});


Breadcrumbs::for('admin.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Roles', route('admin.roles.index'));
});

Breadcrumbs::for('admin.roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.roles.index');
    $trail->push('Create', route('admin.roles.create'));
});

Breadcrumbs::for('admin.roles.show', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('admin.roles.index');
    $trail->push('Show', route('admin.roles.show', $role));
});
Breadcrumbs::for('admin.roles.edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('admin.roles.index');
    $trail->push('Edit', route('admin.roles.edit', $role));
});





// Account
Breadcrumbs::for('admin.features.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Feature', route('admin.features.index'));
});
Breadcrumbs::for('admin.features.edit', function (BreadcrumbTrail $trail, $feature) {
    $trail->parent('admin.features.index');
    $trail->push('Edit', route('admin.features.edit', $feature));
});
Breadcrumbs::for('admin.features.show', function (BreadcrumbTrail $trail, $feature) {
    $trail->parent('admin.features.index');
    $trail->push('Show', route('admin.features.show', $feature));
});

