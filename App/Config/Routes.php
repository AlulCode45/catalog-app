<?php

namespace Config;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('/product/(:num)', 'Home::product/$1');

$routes->add("/login", "Users::login");
$routes->add("/logout", "Users::logout");

$routes->group("admin", function ($routes) {
    $routes->add("", "Home::admin");

    $routes->group("product", function ($routes) {
        $routes->add("create", "Products::create");
        $routes->add("save", "Products::save");
        $routes->add("view", "Products::view");
        $routes->add("delete", "Products::delete");
    });

    $routes->group("category", function ($routes) {
        $routes->add("create", "Category::create");
        $routes->add("save", "Category::save");
        $routes->add("delete", "Category::delete");
        $routes->add("view", "Category::view");
    });

    $routes->group("discount", function ($routes) {
        $routes->add("create", "Discount::create");
        $routes->add("save", "Discount::save");
        $routes->add("delete", "Discount::delete");
        $routes->add("view", "Discount::view");
    });
});

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
