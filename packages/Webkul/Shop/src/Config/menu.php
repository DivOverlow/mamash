<?php

return [
    [
        'key' => 'account',
        'name' => 'shop::app.layouts.my-account',
        'route' =>'customer.profile.index',
        'icon' => '',
        'sort' => 1
    ], [
        'key' => 'account.profile',
        'name' => 'shop::app.layouts.profile',
        'route' =>'customer.profile.index',
        'icon' => 'profile-icon',
        'sort' => 1
    ], [
        'key' => 'account.address',
        'name' => 'shop::app.layouts.address',
        'route' =>'customer.address.index',
        'icon' => 'address-icon',
        'sort' => 2
    ], [
        'key' => 'account.orders',
        'name' => 'shop::app.layouts.orders',
        'route' =>'customer.orders.index',
        'icon' => 'history-icon',
        'sort' => 3
    ], [
        'key' => 'account.subscribe',
        'name' => 'shop::app.layouts.subscribe-newsletter',
        'route' =>'customer.subscribe.index',
        'icon' => 'mail-icon',
        'sort' => 4
    ], [
        'key' => 'account.logout',
        'name' => 'shop::app.layouts.logout',
        'route' =>'customer.session.destroy',
        'icon' => 'leaving-icon',
        'sort' => 5
    ]
];

?>