<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\LoginController;
use App\Controllers\SesionController;
use App\Controllers\UserController;
use App\Controllers\InicioController;
use App\Controllers\HomeController;
use App\Controllers\EventoController;
use App\Controllers\ContribucionController;
use App\Controllers\AboutController;
use App\Controllers\BaseController;
use App\Controllers\PonenteController;
use App\Models\UsuarioEventoModel; 
use App\Controllers\MaterialController;

/**
 * @var RouteCollection $routes
 */


//Rutas de Inicio
$routes->get( 'login', 'LoginController::index',['filter' => 'guest']);
$routes->post( 'auth', 'LoginController::auth', ['filter' => 'guest']);

//$routes->get('home', 'HomeController::index');
$routes->get( 'logout', 'LoginController::logout');
$routes->get( 'register', 'UserController::index', ['filter' => 'guest']);
$routes->post('register','UserController::create', ['filter' => 'guest']);
$routes->get('active-user/(:any)', 'UserController::activateUser/$1');
$routes->get('password-request', 'UserController::linkRequestForm');
$routes->post('password-email', 'UserController::sendResetLinkEmail');
$routes->get('password-reset/(:any)', 'UserController::resetForm/$1');
$routes->post('password/reset', 'UserController::resetPassword');
$routes->get('/', 'InicioController::index');
$routes->get('acerca-de', 'AboutController::index');
$routes->post('eventos/update/(:num)', 'EventoController::update/$1');
//-----------------------------------------------------

//Rutas de Eventos
$routes->group('eventos', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'EventoController::index');
    $routes->get('create', 'EventoController::create');
    $routes->post('store', 'EventoController::store');
    $routes->get('(:num)', 'EventoController::show/$1');
    $routes->get('(:num)/edit', 'EventoController::edit/$1');
    $routes->get('(:num)/delete', 'EventoController::confirmDelete/$1');
    $routes->post('delete/(:num)', 'EventoController::delete/$1');
    $routes->post('eventos/update/(:num)', 'EventoController::update/$1');
});

$routes->get('eventos/general', 'EventoController::general');


//Rutas de ponentes
$routes->get('ponentes', 'PonenteController::index');
$routes->get('ponentes/create', 'PonenteController::create');
$routes->post('ponentes/store', 'PonenteController::store');
$routes->get('ponentes/edit/(:num)', 'PonenteController::edit/$1');
$routes->post('ponentes/update/(:num)', 'PonenteController::update/$1');
$routes->get('ponentes/delete/(:num)', 'PonenteController::confirmDelete/$1');
$routes->post('ponentes/delete/(:num)', 'PonenteController::delete/$1');

//Rutas de Asistentes
$routes->get('asistentes/(:num)', 'AsistenteController::index/$1');
$routes->get('asistentes/create/(:num)', 'AsistenteController::create/$1');
$routes->post('asistentes/store', 'AsistenteController::store');
$routes->get('asistentes/confirmar/(:num)', 'AsistenteController::confirmar/$1');
$routes->get('asistentes/desconfirmar/(:num)', 'AsistenteController::desconfirmar/$1');
$routes->get('asistentes/edit/(:num)', 'AsistenteController::edit/$1');
$routes->post('asistentes/update/(:num)', 'AsistenteController::update/$1');
$routes->get('asistentes', 'AsistenteController::seleccionarEvento');

//$routes->get('asistentes/confirmar-via-token/(:alnum)', 'AsistenteController::confirmarViaToken/$1');
$routes->get('asistentes/confirmar-via-token/(:alphanum)', 'AsistenteController::confirmarViaToken/$1');
$routes->get('asistentes/reEnviarCorreoConfirmacion/(:num)', 'AsistenteController::reEnviarCorreoConfirmacion/$1');
$routes->get('asistentes/confirmar/(:num)', 'AsistenteController::confirmar/$1');
$routes->get('asistentes/desconfirmar/(:num)', 'AsistenteController::desconfirmar/$1');
$routes->get('asistentes/confirmar-via-token/(:segment)', 'AsistenteController::confirmarViaToken/$1');
$routes->post('asistentes/delete/(:num)', 'AsistenteController::delete/$1');


//Rutas de Materiales
$routes->get('/materiales', 'MaterialController::index');
$routes->get('/materiales/create', 'MaterialController::create');
$routes->post('/materiales', 'MaterialController::store');
$routes->get('/materiales/edit/(:num)', 'MaterialController::edit/$1');
$routes->post('/materiales/update/(:num)', 'MaterialController::update/$1');
$routes->get('/materiales/delete/(:num)', 'MaterialController::delete/$1');
$routes->get('/materiales/repositorio', 'MaterialController::repositorio');
$routes->get('/materiales/download/(:num)', 'MaterialController::download/$1');
$routes->post('/materiales/store', 'MaterialController::store');
$routes->get('materiales/show/(:segment)', 'MaterialController::show/$1');

//Rutas de reprogramación
$routes->get('/reprogramaciones', 'ReprogramacionController::index');
$routes->get('/reprogramaciones/create', 'ReprogramacionController::create');
$routes->post('/reprogramaciones/store', 'ReprogramacionController::store');
$routes->get('/reprogramaciones/(:num)', 'ReprogramacionController::show/$1');
$routes->get('/reprogramaciones/edit/(:num)', 'ReprogramacionController::edit/$1');
$routes->post('/reprogramaciones/update/(:num)', 'ReprogramacionController::update/$1');
$routes->get('/reprogramaciones/delete/(:num)', 'ReprogramacionController::delete/$1');


//Filtro aplicado a diversas rutas 
$routes->group('/', ['filter'=>'auth'], function($routes){
$routes->get('home', 'HomeController::index');
//$routes->get('profile', 'UserController::profile');

//RUTA PRIVILEGIOS SOLO PARA ADMIN
$routes->get('admin', 'AdminController::index', ['filter' => 'role:admin']);
});

