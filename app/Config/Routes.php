<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Frontend\Home::index');
// $routes->get('/', 'Auth::login');
$routes->get('register', 'Frontend\Auth::register');
$routes->post('register', 'Frontend\Auth::registerUser');
$routes->get('dashboard', 'Frontend\Auth::dashboard');
$routes->get('login', 'Frontend\Auth::login');
$routes->post('login', 'Frontend\Auth::loginUser');
$routes->get('forgot-password', 'Frontend\Auth::forgotPassword');
$routes->post('forgot-password', 'Frontend\Auth::sendResetLink');
$routes->get('logout', 'Frontend\Auth::logout');
$routes->get('/reset-password', 'Frontend\Auth::resetPassword');
$routes->post('/reset-password', 'Frontend\Auth::handleResetPassword');



// // Admin routes
$routes->get('backend/admin/users', 'Backend\Admin::usersList');
$routes->get('backend/admin/users/view/(:num)', 'Backend\Admin::viewUser/$1');
$routes->get('backend/admin/users/edit/(:num)', 'Backend\Admin::editUser/$1');
$routes->post('backend/admin/users/update/(:num)', 'Backend\Admin::updateUser/$1');
$routes->get('backend/admin/users/delete/(:num)', 'Backend\Admin::deleteUser/$1');
$routes->get('backend/admin/users/export/excel', 'Backend\Admin::exportExcel');
$routes->get('backend/admin/users/export/pdf', 'Backend\Admin::exportPDF');
