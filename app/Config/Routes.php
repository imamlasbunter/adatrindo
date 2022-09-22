<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/login', 'Login::index');
$routes->post('/login/logincheck', 'Login::LoginCheck');
$routes->get('/logout', 'Login::Logout');

//dashboard
// $routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Dashboard::index');
	$routes->get('graph', 'Dashboard::graph');
	$routes->get('popular-product', 'Dashboard::popularProduct');
});

$routes->get('/home', 'Dashboard::index', ['filter' => 'auth']);

$routes->group('suppliers', ['filter' => 'auth'], function ($routes) {
	//suppliers
	$routes->get('/', 'Suppliers::index');
	$routes->get('add', 'Suppliers::add');
	$routes->post('add', 'Suppliers::save');
	$routes->delete('delete/(:num)', 'Suppliers::delete/$1');
	$routes->get('edit/(:num)', 'Suppliers::edit/$1');
	$routes->post('edit/(:num)', 'Suppliers::update/$1');
});

$routes->group('customers', ['filter' => 'auth'], function ($routes) {
	//customers
	$routes->get('/', 'Customers::index');
	$routes->get('add', 'Customers::add');
	$routes->post('add', 'Customers::save');
	$routes->delete('delete/(:num)', 'Customers::delete/$1');
	$routes->get('edit/(:num)', 'Customers::edit/$1');
	$routes->post('edit/(:num)', 'Customers::update/$1');
});

/// product

$routes->group('products', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Product::Index');
	//category
	$routes->get('category', 'Category::index');
	$routes->get('category/add', 'Category::add');
	$routes->post('category/add', 'Category::save');
	$routes->get('category/delete/(:num)', 'Category::delete/$1');
	$routes->get('category/edit/(:num)', 'Category::edit/$1');
	$routes->post('category/edit/(:num)', 'Category::update/$1');
	//unit
	$routes->get('units', 'Units::index');
	$routes->get('units/add', 'Units::add');
	$routes->post('units/add', 'Units::save');
	$routes->get('units/delete/(:num)', 'Units::delete/$1');
	$routes->get('units/edit/(:num)', 'Units::edit/$1');
	$routes->post('units/edit/(:num)', 'Units::update/$1');
	//items
	$routes->get('items', 'Items::index');
	$routes->get('items/add', 'Items::add');
	$routes->post('items/add', 'Items::save');
	$routes->get('items/delete/(:num)', 'Items::delete/$1');
	$routes->get('items/edit/(:num)', 'Items::edit/$1');
	$routes->post('items/edit/(:num)', 'Items::update/$1');
});

// $routes->group('category', ['filter' => 'auth'], function ($routes) {
// });

// $routes->group('units', ['filter' => 'auth'], function ($routes) {
// });

// $routes->group('items', ['filter' => 'auth'], function ($routes) {
// });

/// end product

$routes->group('users', ['filter' => 'auth'], function ($routes) {
	//users
	$routes->get('/', 'Users::index');
	$routes->get('add', 'Users::add');
	$routes->post('add', 'Users::save');
	$routes->delete('delete/(:num)', 'Users::delete/$1');
	$routes->get('edit/(:num)', 'Users::edit/$1');
	$routes->post('edit/(:num)', 'Users::update/$1');
});

$routes->group('user-profile', ['filter' => 'auth'], function ($routes) {
	//User Profile
	$routes->get('/', 'UserProfile::index');
	$routes->get('add', 'UserProfile::add');
	$routes->post('add', 'UserProfile::save');
	$routes->delete('delete/(:num)', 'UserProfile::delete/$1');
	$routes->get('edit/(:num)', 'UserProfile::edit/$1');
	$routes->post('edit/(:num)', 'UserProfile::update/$1');
});

$routes->group('sales', ['filter' => 'auth'], function ($routes) {
	//sales
	$routes->get('/', 'Sales::index');
	$routes->get('getData', 'Sales::getData');
	$routes->get('loadData', 'Sales::loadData');
	$routes->get('add(:any)', 'Sales::add_product/$1');
	$routes->delete('delete/(:num)', 'Sales::delete/$1');
	$routes->get('update/(:num)', 'Sales::update/$1');
	$routes->post('updateCart', 'Sales::updateCart');
	$routes->get('get-grand-total', 'Sales::getGrandTotal');
	$routes->post('submit-payment', 'Sales::submitPayment');
	$routes->post('invoice', 'Sales::invoice');
	$routes->post('list-invoice', 'Sales::listInvoice');
	// $routes->get('invoice-print', 'Sales::invoicePrint');
	$routes->get('invoice-print', 'Sales::invoicePrint2');
	$routes->get('surat-jalan', 'Sales::suratJalan');
});

$routes->group('sales-report', ['filter' => 'auth'], function ($routes) {
	//sales report
	$routes->get('/', 'SalesReport::index');
	$routes->get('product-sales', 'SalesReport::productSales');
	$routes->get('product-sales1', 'SalesReport::productSales1');
	$routes->post('product-sales/graph', 'SalesReport::graph'); // for ajax
	$routes->post('product-sales/graph2', 'SalesReport::graph2'); // for ajax
	$routes->get('popular-product', 'SalesReport::PopularProduct');
	$routes->get('invoice', 'SalesReport::invoiceReport');
	$routes->get('invoice-detail', 'SalesReport::invoice');
});

$routes->group('stock-in-out-report', ['filter' => 'auth'], function ($routes) {
	//stock in/out report
	$routes->get('/', 'StockinoutReport::index');
	$routes->get('stock-in', 'StockinoutReport::StockIn');
	$routes->get('stock-out', 'StockinoutReport::StockOut');
	$routes->post('stock-in/graph', 'StockinoutReport::graph'); // for ajax
	$routes->post('stock-out/graph2', 'StockinoutReport::graph2'); // for ajax
	$routes->get('popular-product', 'StockinoutReport::PopularProduct');
});

$routes->group('menu', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Menu::index');
	$routes->get('add', 'Menu::add');
	$routes->post('add', 'Menu::save');
	$routes->get('add-submenu/(:num)', 'Menu::add_submenu/$1');
	$routes->post('add-submenu/(:num)', 'Menu::save_submenu/$1');
	$routes->delete('delete/(:num)', 'Menu::delete/$1');
	$routes->get('edit/(:num)', 'Menu::edit/$1');
	$routes->post('edit/(:num)', 'Menu::update/$1');
});

$routes->group('roles', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Roles::index');
	$routes->get('add/level', 'Roles::add');
	$routes->post('add/level', 'Roles::save');
	$routes->get('delete/level/(:num)', 'Roles::del_role_menu/$1');
	$routes->get('edit/level/(:num)', 'Roles::edit/$1');
	$routes->post('edit/level/(:num)', 'Roles::update/$1');
	$routes->get('access/level/(:num)', 'Roles::access/$1');
	$routes->post('access/save/', 'Roles::access_save/$1');
});

$routes->group('company', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Company::index');
	$routes->post('add', 'Company::save');
	$routes->post('update', 'Company::update');
});

$routes->group('journal-setting', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'AccountSetting::index');
	$routes->post('save_data', 'AccountSetting::save_data');
	$routes->get('category', 'AccountSetting::category_index');
	$routes->get('category/add', 'AccountSetting::category_add');
	$routes->post('category/save', 'AccountSetting::category_save');
	$routes->get('category/edit/(:num)', 'AccountSetting::category_edit/$1');
	$routes->post('category/edit/(:num)', 'AccountSetting::category_update/$1');
	$routes->get('category/delete/(:num)', 'AccountSetting::category_delete/$1');
	$routes->get('list', 'AccountSetting::list_index');
	$routes->get('list/add', 'AccountSetting::list_add');
	$routes->post('list/add', 'AccountSetting::list_save');
	$routes->get('list/edit/(:num)', 'AccountSetting::list_edit/$1');
	$routes->post('list/edit/(:num)', 'AccountSetting::list_update/$1');
});

$routes->group('contact', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Contact::index');
	$routes->get('add', 'Contact::add');
	$routes->post('add', 'Contact::save');
	$routes->get('edit/(:num)', 'Contact::edit/$1');
	$routes->post('edit/(:num)', 'Contact::update/$1');
	$routes->get('delete/(:num)', 'Contact::delete/$1');
});

$routes->group('stock-out', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'StockOut::index');
	$routes->post('save', 'StockOut::save');
	$routes->get('detail/(:any)', 'StockOut::detail/$1');
	$routes->post('restore', 'StockOut::save_restore');
});

$routes->group('stock-in', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'StockIn::index');
	$routes->post('save', 'StockIn::save');
	$routes->get('detail/(:any)', 'StockIn::detail/$1');
	$routes->post('restore', 'StockIn::save_restore');
});

$routes->group('discount-program', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'DiscountProgram::index');
	$routes->get('add', 'DiscountProgram::add');
	$routes->get('edit', 'DiscountProgram::edit');
	$routes->get('delete/(:any)', 'DiscountProgram::delete/$1');
	$routes->post('save', 'DiscountProgram::save');
});

$routes->group('discount-program-in', ['filter' => 'auth'], function ($routes) {
	$routes->get('add', 'DiscountProgram::add_in');
	$routes->get('edit', 'DiscountProgram::edit_in');
	$routes->get('delete/(:any)', 'DiscountProgram::delete_in/$1');
	$routes->post('save', 'DiscountProgram::save_in');
	$routes->get('detail/(:any)', 'DiscountProgram::detail_in/$1');
});

$routes->group('tax', ['filter' => 'auth'], function ($routes) {
	$routes->get('add', 'tax::add');
	$routes->get('edit', 'tax::edit');
	$routes->get('delete/(:any)', 'tax::delete/$1');
	$routes->post('save', 'taxx::save');
});




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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
