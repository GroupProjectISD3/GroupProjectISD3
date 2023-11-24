<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
//Admin Routes
$routes->setDefaultController('AdminDashboardController');
$routes->get('/', 'AdminDashboardController::index');
$routes->get('/viewProductsDashboard', 'AdminDashboardController::viewProductsDashboard');
$routes->get('/viewProductsDashboard', 'AdminDashboardController::viewProductsDashboard');
$routes->get('/viewAddProductDashboard', 'AdminDashboardController::viewAddProductDashboard');
$routes->get('/viewMembersDashboard', 'AdminDashboardController::viewMembersDashboard');
$routes->get('/viewStaffsDashboard', 'AdminDashboardController::viewStaffsDashboard');
$routes->get('/viewAddNewStaff', 'AdminDashboardController::viewAddNewStaff'); //viewAddNewStaff
$routes->get('/viewSalesDashboard', 'AdminDashboardController::viewSalesDashboard');

$routes->get('deleteProduct/(:num)', 'AdminDashboardController::deleteProduct/$1');//updateProductDashboard
$routes->get('updateProduct/(:num)', 'AdminDashboardController::updateProduct/$1');


//Member Routes

$routes->get('/products', 'MemberController::products');
$routes->get('/index', 'MemberController::index');
$routes->get('/faq', 'MemberController::faq');
$routes->get('/portal', 'MemberController::register');
$routes->get('/memberlogin', 'LoginController::index');
$routes->get('/contact', 'MemberController::contact');
$routes->get('/wishlist', 'MemberController::wishlist');
$routes->get('/cart', 'MemberController::cart');
$routes->get('/checkout', 'MemberController::checkout');
$routes->get('/adminLogin', 'MemberController::adminLogin');
$routes->get('/productDescription', 'MemberController::productDescription');


//Admin Routes

$routes->get('/categoryDashboard', 'AdminDashboardController::categoryDashboard');
$routes->get('/viewCategoryDashboard', 'AdminDashboardController::viewCategoryDashboard');
$routes->get('/viewAddCategoryDashboard', 'AdminDashboardController::viewAddCategoryDashboard');





$routes->post('/addCategory', 'AdminDashboardController::addCategory');

$routes->get('/dashboard', 'AdminDashboardController::dashboard');
$routes->post('/addProduct', 'AdminDashboardController::addProduct');
$routes->get('/logout', 'AdminDashboardController::logout');


// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
