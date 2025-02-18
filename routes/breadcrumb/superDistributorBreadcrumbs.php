<?php 
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('superdistributor.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('superdistributor.dashboard'));
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