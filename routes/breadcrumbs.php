<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function(BreadcrumbTrail $trail){
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('category.show', function (BreadcrumbTrail $trail, $name) {
    $trail->parent('home');
    $trail->push($name, route('category.show', $name));
});

Breadcrumbs::for('subcategory.show', function (BreadcrumbTrail $trail, $name, $subCategory) {
    $trail->parent('category.show', $name);
    $trail->push($subCategory, route('subcategory.show', [$name, $subCategory]));
});

