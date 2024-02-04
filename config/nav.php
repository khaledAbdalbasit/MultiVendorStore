<?php

return [
    [
        'icon'=> 'nav-icon fas fa-tachometer-alt',
        'route'=>'dashboard.dashboard',
        'title'=>'Dashboard',
        'active'=> 'dashboard.dashboard'
    ]
,
    [
        'icon' => 'fas fa-tags nav-icon',
        'route'=>'dashboard.categories.index',
        'title'=>'Categorries',
        'badge'=>'New',
        'active' => 'dashboard.categories.*',
        'ability' => 'categories.view',
    ]
,
    [
        'icon' => 'fas fa-box nav-icon',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'active' => 'dashboard.products.*',
        'ability' => 'products.view',
    ],
    [
        'icon' => 'fas fa-receipt nav-icon',
        'route' => 'dashboard.categories.index',
        'title' => 'Orders',
        'active' => 'dashboard.orders.*',
        'ability' => 'orders.view',
    ],
    [
        'icon' => 'fas fa-receipt nav-icon',
        'route' => 'dashboard.roles.index',
        'title' => 'Roles',
        'active' => 'dashboard.roles.*',
        'ability' => 'roles.view',
    ],
];
