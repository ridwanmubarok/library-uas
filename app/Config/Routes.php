<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::landing');

// Auth
$routes->get('login', 'Auth::login');
$routes->post('login/process', 'Auth::login_process');
$routes->get('logout', 'Auth::logout');

// Buku (user & admin)
$routes->get('buku', 'Buku::index', ['filter' => 'auth']);
$routes->get('buku/detail/(:num)', 'Buku::detail/$1', ['filter' => 'auth']);

// Admin dashboard
$routes->get('admin', 'Admin::dashboard', ['filter' => ['auth', 'admin']]);

// CRUD buku (admin)
$routes->get('buku/create', 'Buku::create', ['filter' => ['auth', 'admin']]);
$routes->post('buku/store', 'Buku::store', ['filter' => ['auth', 'admin']]);
$routes->get('buku/edit/(:num)', 'Buku::edit/$1', ['filter' => ['auth', 'admin']]);
$routes->post('buku/update/(:num)', 'Buku::update/$1', ['filter' => ['auth', 'admin']]);
$routes->get('buku/delete/(:num)', 'Buku::delete/$1', ['filter' => ['auth', 'admin']]);

// Loan routes
$routes->get('loan', 'Loan::index', ['filter' => 'auth']);
$routes->get('loan/borrow/(:num)', 'Loan::borrow/$1', ['filter' => 'auth']);
$routes->post('loan/store', 'Loan::store', ['filter' => 'auth']);
$routes->get('loan/request-return/(:num)', 'Loan::requestReturn/$1', ['filter' => 'auth']);
$routes->get('loan/confirm-return/(:num)', 'Loan::confirmReturn/$1', ['filter' => ['auth', 'admin']]);
$routes->get('loan/pending-returns', 'Loan::pendingReturns', ['filter' => ['auth', 'admin']]);
$routes->get('loan/delete/(:num)', 'Loan::delete/$1', ['filter' => ['auth', 'admin']]);
$routes->get('loan/reject-return/(:num)', 'Loan::rejectReturn/$1', ['filter' => ['auth', 'admin']]);
