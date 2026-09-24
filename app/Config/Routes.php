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

$routes->get('admin/products', 'ProductController::index', ['filter' => 'auth:Administrator']);
$routes->get('admin/products/create', 'ProductController::create', ['filter' => 'auth:Administrator']);
$routes->post('admin/products', 'ProductController::store', ['filter' => 'auth:Administrator']);
$routes->get('admin/products/(:num)/edit', 'ProductController::edit/$1', ['filter' => 'auth:Administrator']);
$routes->post('admin/products/(:num)', 'ProductController::update/$1', ['filter' => 'auth:Administrator']);
$routes->post('admin/products/(:num)/delete', 'ProductController::delete/$1', ['filter' => 'auth:Administrator']);

$routes->get('qc/product-units', 'ProductUnitController::index', ['filter' => 'auth:Petugas QC']);
$routes->get('qc/product-units/create', 'ProductUnitController::create', ['filter' => 'auth:Petugas QC']);
$routes->post('qc/product-units', 'ProductUnitController::store', ['filter' => 'auth:Petugas QC']);
