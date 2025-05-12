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


//Rutas de Inicio-------------------------------------------------
$routes->get('login', 'LoginController::index', ['filter' => 'guest']);
$routes->post('auth', 'LoginController::auth', ['filter' => 'guest']);
$routes->get('logout', 'LoginController::logout');

$routes->get('register', 'UserController::index', ['filter' => 'guest']);
$routes->post('register', 'UserController::create', ['filter' => 'guest']);
$routes->get('active-user/(:any)', 'UserController::activateUser/$1');
$routes->get('password-request', 'UserController::linkRequestForm');
$routes->post('password-email', 'UserController::sendResetLinkEmail');
$routes->get('password-reset/(:any)', 'UserController::resetForm/$1');
$routes->post('password/reset', 'UserController::resetPassword');
$routes->get('/', 'InicioController::index');
$routes->get('acerca-de', 'AboutController::index');
$routes->post('eventos/update/(:num)', 'EventoController::update/$1');

//---------------------------------------------------------------
//Filtro aplicado a diversas rutas 
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('home', 'HomeController::index');


    //RUTA PRIVILEGIOS SOLO PARA ADMIN
    $routes->get('admin', 'AdminController::index', ['filter' => 'role:admin']);
});

//---------------------------------------------------------------
//Rutas de Eventos
$routes->group('eventos', ['filter' => 'role:admin,investigador'], function ($routes) {
    //$routes->group('eventos', ['filter' => 'auth'], function ($routes) {
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

//---------------------------------------------------------------
//Rutas de ponentes
$routes->group('ponentes', ['filter' => 'role:admin,investigador'], function ($routes) {
    $routes->get('/', 'PonenteController::index');
    $routes->get('create', 'PonenteController::create');
    $routes->post('store', 'PonenteController::store');
    $routes->get('edit/(:num)', 'PonenteController::edit/$1');
    $routes->post('update/(:num)', 'PonenteController::update/$1');
    $routes->get('delete/(:num)', 'PonenteController::confirmDelete/$1');
    $routes->post('delete/(:num)', 'PonenteController::delete/$1');
});

//---------------------------------------------------------------
//Rutas de Asistentes
$routes->group('asistentes', ['filter' => 'role:admin,investigador'], function ($routes) {
    $routes->get('/', 'AsistenteController::index');
    $routes->get('(:num)', 'AsistenteController::index/$1');
    $routes->get('create/(:num)', 'AsistenteController::create/$1');
    $routes->post('store', 'AsistenteController::store');
    $routes->get('confirmar/(:num)', 'AsistenteController::confirmar/$1');
    $routes->get('desconfirmar/(:num)', 'AsistenteController::desconfirmar/$1');
    $routes->get('edit/(:num)', 'AsistenteController::edit/$1');
    $routes->post('update/(:num)', 'AsistenteController::update/$1');
    $routes->get('confirmar-via-token/(:alphanum)', 'AsistenteController::confirmarViaToken/$1');
    $routes->get('reEnviarCorreoConfirmacion/(:num)', 'AsistenteController::reEnviarCorreoConfirmacion/$1');
    $routes->get('confirmar/(:num)', 'AsistenteController::confirmar/$1');
    $routes->get('desconfirmar/(:num)', 'AsistenteController::desconfirmar/$1');
    $routes->get('confirmar-via-token/(:segment)', 'AsistenteController::confirmarViaToken/$1');
    $routes->post('delete/(:num)', 'AsistenteController::delete/$1');
});


//---------------------------------------------------------------
//Rutas de Materiales
$routes->group('materiales', ['filter' => 'role:admin,investigador'], function ($routes) {
    $routes->get('/', 'MaterialController::index');
    $routes->get('create', 'MaterialController::create');
    $routes->post('/', 'MaterialController::store');
    $routes->get('edit/(:num)', 'MaterialController::edit/$1');
    $routes->post('update/(:num)', 'MaterialController::update/$1');
    $routes->get('delete/(:num)', 'MaterialController::delete/$1');
    $routes->get('repositorio', 'MaterialController::repositorio');
    $routes->get('download/(:num)', 'MaterialController::download/$1');
    $routes->post('store', 'MaterialController::store');
    $routes->get('show/(:segment)', 'MaterialController::show/$1');
});

//---------------------------------------------------------------
//ADMIN EVENTOS
$routes->group('admin/eventos', ['filter' => 'role:admin'], function ($routes) {
    // Lista de eventos (admin)
    $routes->get('', 'EventoController::index');
    $routes->get('create', 'EventoController::create');
    $routes->post('store', 'EventoController::store');
    $routes->get('(:num)', 'EventoController::show/$1');
    $routes->get('(:num)/edit', 'EventoController::edit/$1');
    $routes->get('(:num)/delete', 'EventoController::confirmDelete/$1');
    $routes->post('delete/(:num)', 'EventoController::delete/$1');
    $routes->post('eventos/update/(:num)', 'EventoController::update/$1');
});

//ADMIN PONENTES
$routes->group('admin/ponentes', ['filter' => 'role:admin'], function($routes) {
    $routes->get('/', 'PonenteController::index');
    $routes->get('create', 'PonenteController::create');
    $routes->post('store', 'PonenteController::store');
    $routes->get('edit/(:num)', 'PonenteController::edit/$1');
    $routes->post('update/(:num)', 'PonenteController::update/$1');
    $routes->get('delete/(:num)', 'PonenteController::confirmDelete/$1');
    $routes->post('delete/(:num)', 'PonenteController::delete/$1');
});

//ADMIN ASISTENTES
$routes->group('admin/asistentes', ['filter' => 'role:admin'], function($routes) {
    $routes->get('/', 'AsistenteController::index');
    $routes->get('(:num)', 'AsistenteController::index/$1');
    $routes->get('create/(:num)', 'AsistenteController::create/$1');
    $routes->post('store', 'AsistenteController::store');
    $routes->get('confirmar/(:num)', 'AsistenteController::confirmar/$1');
    $routes->get('desconfirmar/(:num)', 'AsistenteController::desconfirmar/$1');
    $routes->get('edit/(:num)', 'AsistenteController::edit/$1');
    $routes->post('update/(:num)', 'AsistenteController::update/$1');
    $routes->get('confirmar-via-token/(:alphanum)', 'AsistenteController::confirmarViaToken/$1');
    $routes->get('reEnviarCorreoConfirmacion/(:num)', 'AsistenteController::reEnviarCorreoConfirmacion/$1');
    $routes->get('confirmar/(:num)', 'AsistenteController::confirmar/$1');
    $routes->get('desconfirmar/(:num)', 'AsistenteController::desconfirmar/$1');
    $routes->get('confirmar-via-token/(:segment)', 'AsistenteController::confirmarViaToken/$1');
    $routes->post('delete/(:num)', 'AsistenteController::delete/$1');
});

//ADMIN MATERIALES
$routes->group('admin/materiales', ['filter' => 'role:admin'], function($routes) {
    $routes->get('/', 'MaterialController::index');
    $routes->get('create', 'MaterialController::create');
    $routes->post('/', 'MaterialController::store');
    $routes->get('edit/(:num)', 'MaterialController::edit/$1');
    $routes->post('update/(:num)', 'MaterialController::update/$1');
    $routes->get('delete/(:num)', 'MaterialController::delete/$1');
    $routes->get('repositorio', 'MaterialController::repositorio');
    $routes->get('download/(:num)', 'MaterialController::download/$1');
    $routes->post('store', 'MaterialController::store');
    $routes->get('show/(:segment)', 'MaterialController::show/$1');
});


