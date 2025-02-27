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
Breadcrumbs::for('superdistributor.wallet.show', function (BreadcrumbTrail $trail,$transaction) {
    $trail->parent('superdistributor.wallet.index');
    $trail->push('Show', route('superdistributor.wallet.show',$transaction));
});

// recharge
Breadcrumbs::for('superdistributor.wallet-recharge.create', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.dashboard');
    $trail->push('Recharge', route('superdistributor.wallet-recharge.create'));
});


// plan
Breadcrumbs::for('superdistributor.myplan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('superdistributor.dashboard');
    $trail->push('My Plan', route('superdistributor.myplan.index'));
});
Breadcrumbs::for('superdistributor.myplan.activation', function (BreadcrumbTrail $trail,$planDetail) {
    $trail->parent('superdistributor.myplan.index');
    $trail->push('Activation', route('superdistributor.myplan.activation',$planDetail));
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