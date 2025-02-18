<?php 
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('retailer.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('retailer.dashboard'));
});

// Account
Breadcrumbs::for('retailer.account.index', function (BreadcrumbTrail $trail) {
    $trail->parent('retailer.dashboard');
    $trail->push('Account', route('retailer.account.index'));
});
Breadcrumbs::for('retailer.account.update', function (BreadcrumbTrail $trail) {
    $trail->parent('retailer.account.index');
    $trail->push('Profile Update', route('retailer.account.update'));
});
Breadcrumbs::for('retailer.account.password', function (BreadcrumbTrail $trail) {
    $trail->parent('retailer.account.index');
    $trail->push('Change Password', route('retailer.account.password'));
});