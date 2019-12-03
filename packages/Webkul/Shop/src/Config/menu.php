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
        'key' => 'account.wishlist',
        'name' => 'shop::app.layouts.subscribe-newsletter',
        'route' =>'customer.wishlist.index',
        'icon' => 'mail-icon',
        'sort' => 4
    ], [
        'key' => 'account.downloadables',
        'name' => 'shop::app.layouts.logout',
        'route' =>'customer.downloadable_products.index',
        'icon' => 'leaving-icon',
        'sort' => 5
    ]
//    [
//        'key' => 'account.address',
//        'name' => 'shop::app.layouts.address',
//        'route' =>'customer.address.index',
//        'sort' => 2
//    ], [
//        'key' => 'account.reviews',
//        'name' => 'shop::app.layouts.reviews',
//        'route' =>'customer.reviews.index',
//        'sort' => 3
//    ], [
//        'key' => 'account.wishlist',
//        'name' => 'shop::app.layouts.wishlist',
//        'route' =>'customer.wishlist.index',
//        'sort' => 4
//    ], [
//        'key' => 'account.orders',
//        'name' => 'shop::app.layouts.orders',
//        'route' =>'customer.orders.index',
//        'sort' => 5
//    ],
//    [
//        'key' => 'account.downloadables',
//        'name' => 'shop::app.layouts.downloadable-products',
//        'route' =>'customer.downloadable_products.index',
//        'sort' => 6
//    ]
];

?>