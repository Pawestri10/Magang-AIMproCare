<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('login-hanyaadmin', 'LoginController::admin');
$routes->get('login-hanyaqc', 'LoginController::qc');
$routes->post('login-hanyaadmin', 'LoginController::admin');
$routes->post('login-hanyaqc', 'LoginController::qc');

$routes->get('logout', 'LoginController::logout');

$routes->get('admin/dashboard', 'DashboardController::admin', ['filter' => 'auth:Administrator']);
$routes->get('qc/dashboard', 'DashboardController::qc', ['filter' => 'auth:Petugas QC']);
