<?php
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push( __('shop::app.home.name'), route('shop.home.index'));
});
Breadcrumbs::for('categories', function ($breadcrumbs, $categories, $category) {
    $breadcrumbs->parent('home');
    foreach ($categories as $ancestor) {
        $breadcrumbs->push($ancestor->name, route('shop.categories.index', $ancestor->slug));
    }
    $breadcrumbs->push($category->name, route('shop.categories.index', $category->slug));
});