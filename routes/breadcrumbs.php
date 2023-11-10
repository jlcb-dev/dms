<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
// Home
// Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
//     $trail->push('Home', route('home'));
// });

// // Home > Blog
// Breadcrumbs::for('leads_view', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Leads', route('leads_view', ['lead_type' => request('lead_type')]));
    
// });

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'))->icon('home-icon'); // Set the 'home-icon' class for the Home icon
});

Breadcrumbs::for('leads_view', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Leads', route('leads_view', ['lead_type' => request('lead_type')])); // Set the 'user-icon' class for the User icon
});

