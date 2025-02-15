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

// api client
Breadcrumbs::for('admin.api-clients.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Api Client', route('admin.api-clients.index'));
});
Breadcrumbs::for('admin.api-clients.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.api-clients.index');
    $trail->push('Create', route('admin.api-clients.create'));
});
Breadcrumbs::for('admin.api-clients.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.api-clients.index');
    $trail->push('Show', route('admin.api-clients.show', $user));
});
Breadcrumbs::for('admin.api-clients.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.api-clients.index');
    $trail->push('Edit', route('admin.api-clients.edit', $user));
});
// super-distributor
Breadcrumbs::for('admin.super-distributors.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Super Distributor', route('admin.super-distributors.index'));
});
Breadcrumbs::for('admin.super-distributors.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.super-distributors.index');
    $trail->push('Create', route('admin.super-distributors.create'));
});
Breadcrumbs::for('admin.super-distributors.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.super-distributors.index');
    $trail->push('Show', route('admin.super-distributors.show', $user));
});
Breadcrumbs::for('admin.super-distributors.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.super-distributors.index');
    $trail->push('Edit', route('admin.super-distributors.edit', $user));
});
// distributor
Breadcrumbs::for('admin.distributors.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Distributor', route('admin.distributors.index'));
});
Breadcrumbs::for('admin.distributors.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.distributors.index');
    $trail->push('Create', route('admin.distributors.create'));
});
Breadcrumbs::for('admin.distributors.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.distributors.index');
    $trail->push('Show', route('admin.distributors.show', $user));
});
Breadcrumbs::for('admin.distributors.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.distributors.index');
    $trail->push('Edit', route('admin.distributors.edit', $user));
});
// retailer
Breadcrumbs::for('admin.retailers.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Retailer', route('admin.retailers.index'));
});
Breadcrumbs::for('admin.retailers.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.retailers.index');
    $trail->push('Create', route('admin.retailers.create'));
});
Breadcrumbs::for('admin.retailers.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.retailers.index');
    $trail->push('Show', route('admin.retailers.show', $user));
});
Breadcrumbs::for('admin.retailers.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.retailers.index');
    $trail->push('Edit', route('admin.retailers.edit', $user));
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


Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Users', route('admin.users.index'));
});
Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Create', route('admin.users.create'));
});
Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Show', route('admin.users.show', $user));
});
Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Edit', route('admin.users.edit', $user));
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

