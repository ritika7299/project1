<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'FileUpload::index');
$routes->post('FileUpload/upload', 'FileUpload::upload');
