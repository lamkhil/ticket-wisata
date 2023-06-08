<?php

use CodeIgniter\Router\RouteCollection as Routes;
use Fluent\Auth\Facades\Auth;

/** @var \CodeIgniter\Router\RouteCollection $routes */

// Includes auth routes.

$routes->get('/klaim','User\TiketController::klaim');