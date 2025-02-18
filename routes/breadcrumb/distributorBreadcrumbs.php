<?php 
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('distributor.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('distributor.dashboard'));
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