<?php 
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('apiclient.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('apiclient.dashboard'));
});

// Account
Breadcrumbs::for('apiclient.account.index', function (BreadcrumbTrail $trail) {
    $trail->parent('apiclient.dashboard');
    $trail->push('Account', route('apiclient.account.index'));
});
Breadcrumbs::for('apiclient.account.update', function (BreadcrumbTrail $trail) {
    $trail->parent('apiclient.account.index');
    $trail->push('Profile Update', route('apiclient.account.update'));
});
Breadcrumbs::for('apiclient.account.password', function (BreadcrumbTrail $trail) {
    $trail->parent('apiclient.account.index');
    $trail->push('Change Password', route('apiclient.account.password'));
});