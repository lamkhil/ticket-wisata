<?php

use CodeIgniter\Router\RouteCollection as Routes;
use Fluent\Auth\Facades\Auth;

/** @var \CodeIgniter\Router\RouteCollection $routes */

// Includes auth routes.
Auth::routes();

$routes->get('/','Home::index');

$routes->get('/dashboard', 'Home::dashboard', ['filter' => 'auth:web']);