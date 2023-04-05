<?php

use CodeIgniter\Router\RouteCollection as Routes;
use Fluent\Auth\Facades\Auth;

/** @var \CodeIgniter\Router\RouteCollection $routes */

// Includes auth routes.
Auth::routes();

$routes->get('/','Home::index');

$routes->get('/admin', 'Home::admin');

$routes->group('/',['filter'=>'auth:web'], static function($routes){
    $routes->get('transaksi', 'Home::transaksi');
    $routes->get('dashboard', 'Home::dashboard');
    $routes->get('scan', 'Home::scan');
    $routes->get('wisata', 'Home::wisata');
    $routes->group('wisata', ['namespace'=>'\App\Controllers\Admin'], static function($routes){
        $routes->get('create', 'WisataController::index');
    });
});