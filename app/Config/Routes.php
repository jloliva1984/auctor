<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Orders');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Orders::dashboard');

$routes->post('Products/productManagement','Products::productsManagement');

$routes->get('Products/productManagement','Products::productsManagement');
$routes->get('Accounts/accountManagement','Accounts::accountManagement');

$routes->post('Products/getProducts/(:any)','Products::getProducts');
$routes->post('/Orders/saveOrder/','Orders::saveOrder');
$routes->post('/Orders/getOrderDetails/(:any)','Orders::getOrderDetails');

$routes->get('/SubElementosGastos','SubElementosGastos::subelementosgastos_management');

$routes->group('',['filter'=>'CheckIfLogged'],function($routes)//llama al filtro que chequea si esta logueado antes de acceder a las rutas
{
	$routes->get('/home', 'Home::index');
	$routes->get('/', 'Home::index');
	
      
	 $routes->match(['get', 'post'],'/proyectos/(:any)', 'Proyectos::proyectos_management',['as'=>'proyectos']);
	 

     $routes->get('/planificacion/(:any)', 'Planificacion::proyectos_management');
	 $routes->get('/planificacion', 'Planificacion::proyectos_management');
	 
	 $routes->post('/SubElementosGastos/(:any)','SubElementosGastos::subelementosgastos_management');
	 $routes->get('/SubElementosGastos','SubElementosGastos::subelementosgastos_management');

	 $routes->post('/Especialidades/(:any)','Especialidades::especialidades_management');
	 $routes->get('/Especialidades','Especialidades::especialidades_management');


	 $routes->post('Proyectos/descarga_carga_inicial/(:any)','Proyectos::descarga_carga_inicial');
	 $routes->get('Proyectos/descarga_carga_inicial/(:any)','Proyectos::descarga_carga_inicial');
	 

	 //$routes->get('/Especialistas/(:any)','Especialistas::especialistas_management');

	 $routes->get('/Usuarios/(:any)','Usuarios::usuarios_management');

	 $routes->get('/Codificadores','Codificadores::user_rol_show');

	//  $routes->post('/proyectos/(:any)','Proyectos::proyectos_management');
	//  $routes->get('/proyectos/(:any)','Proyectos::proyectos_management');
	 $routes->match(['get', 'post'],'/proyectos/(:any)', 'Proyectos::proyectos_management');
	 $routes->match(['get', 'post'],'/proyectos/(:any)', 'Proyectos::proyectos_management');
	 $routes->post('/proyectos/delete/(:any)', 'Proyectos::proyectos_management/delete/(:any)');
	$routes->get('/subelementos_gasto/(:any)','SubElementosGastos::SubElementosGastos_management');




}
);



//rutas auctor
$routes->post('Pacientes/pacientesManagement','Pacientes::pacientesManagement');
$routes->get('Pacientes/pacientesManagement','Pacientes::pacientesManagement');

$routes->get('Clinicas/clinicasManagement','Clinicas::clinicasManagement');
$routes->post('Clinicas/clinicasManagement','Clinicas::clinicasManagement');

$routes->get('Empresas/empresasManagement','Empresas::empresasManagement');



/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
