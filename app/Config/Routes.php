<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->post('login', 'AuthController::login');
$routes->group('/', ['filter' => 'auth'], function($routes) {
    $routes->post('logout', 'AuthController::logout');

    $routes->get('posts', 'PostController::index');
    $routes->post('posts', 'PostController::create');
    $routes->get('posts/(:any)', 'PostController::show/$1');
    $routes->patch('posts/(:any)', 'PostController::update/$1');
    $routes->delete('posts/(:any)', 'PostController::delete/$1');
});