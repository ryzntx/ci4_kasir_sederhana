<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Auth::login');
$routes->get('/', function () {
    if (session()->get('logged_in')) {
        return redirect()->back();
    }
    return redirect()->to('auth/login');
});

$routes->group('auth', function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::process');
    $routes->get('logout', 'Auth::logout');
});

$routes->group('', [ 'filter' => 'auth' ], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    // Grouping routes for admin
    $routes->group('admin', [ 'filter' => 'rolecheck:admin' ], function ($routes) {
        // $routes->get('dashboard', 'Dashboard::index');

        $routes->group('users', function ($routes) {
            $routes->get('/', 'Users::index');
            $routes->get('create', 'Users::new');
            $routes->post('store', 'Users::create');
            $routes->get('show/(:num)', 'Users::show/$1');
            $routes->get('edit/(:num)', 'Users::edit/$1');
            $routes->post('update/(:num)', 'Users::update/$1');
            $routes->get('delete/(:num)', 'Users::delete/$1');
        });

        $routes->group('menu', function ($routes) {
            $routes->get('/', 'Menu::index');
            $routes->get('create', 'Menu::new');
            $routes->post('store', 'Menu::create');
            $routes->get('show/(:num)', 'Menu::show/$1');
            $routes->get('edit/(:num)', 'Menu::edit/$1');
            $routes->post('update/(:num)', 'Menu::update/$1');
            $routes->get('delete/(:num)', 'Menu::delete/$1');
        });
    });

    // Grouping routes for kasir
    $routes->group('kasir', [ 'filter' => 'rolecheck:kasir' ], function ($routes) {
        // $routes->get('dashboard', 'Dashboard::index');

        $routes->group('transaksi', function ($routes) {
            $routes->get('/', 'Transaksi::index');

            $routes->get('create', 'Transaksi::new');
            $routes->post('store', 'Transaksi::storeToCart');
            $routes->get('delete/item/(:any)', 'Transaksi::deleteItemFromCart/$1');
            $routes->post('change-quantity-item/(:any)', 'Transaksi::changeQuantityItem/$1');
            $routes->get('clear-cart', 'Transaksi::clearCart');

            $routes->post('checkout', 'Transaksi::checkout');

            $routes->get('show/(:num)', 'Transaksi::show/$1');
            $routes->get('print/(:num)', 'Transaksi::print/$1');
        });

        $routes->get('laporan', 'Laporan::index');

    });
});
