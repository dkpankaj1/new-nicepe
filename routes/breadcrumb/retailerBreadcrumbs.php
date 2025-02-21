<?php 
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('retailer.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('retailer.dashboard'));
});

// wallet 
Breadcrumbs::for('retailer.wallet.index', function (BreadcrumbTrail $trail) {
    $trail->parent('retailer.dashboard');
    $trail->push('Wallet', route('retailer.wallet.index'));
});
Breadcrumbs::for('retailer.wallet.show', function (BreadcrumbTrail $trail,$transaction) {
    $trail->parent('retailer.wallet.index');
    $trail->push('Show', route('retailer.wallet.show',$transaction));
});

// recharge
Breadcrumbs::for('retailer.wallet-recharge.create', function (BreadcrumbTrail $trail) {
    $trail->parent('retailer.dashboard');
    $trail->push('Recharge', route('retailer.wallet-recharge.create'));
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