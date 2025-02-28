<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/admin/dashboard', 'AdminController::dashboard');

$routes->get('/login', 'AuthController::loginForm'); // Formulario de login
$routes->post('/login', 'AuthController::login'); // Procesar login
$routes->get('/logout', 'AuthController::logout'); // Cerrar sesión

// Proteger Dashboard con autenticación
$routes->get('/admin/dashboard', 'AdminController::dashboard', ['filter' => 'auth']);

$routes->get('/admin/premios', 'PremiosController::premios');
$routes->get('/admin/premios/nuevo', 'PremiosController::nuevoPremio');
$routes->post('/admin/premios/guardar', 'PremiosController::guardarPremio');
$routes->get('/admin/premios/editar/(:num)', 'PremiosController::editarPremio/$1');
$routes->post('/admin/premios/actualizar/(:num)', 'PremiosController::actualizarPremio/$1');
$routes->get('/admin/premios/eliminar/(:num)', 'PremiosController::eliminarPremio/$1');

$routes->get('/admin/beneficios', 'BeneficiosController::beneficios');
$routes->get('/admin/beneficios/nuevo', 'BeneficiosController::nuevoBeneficio');
$routes->post('/admin/beneficios/guardar', 'BeneficiosController::guardarBeneficio');
$routes->get('/admin/beneficios/editar/(:num)', 'BeneficiosController::editarBeneficio/$1');
$routes->post('/admin/beneficios/actualizar/(:num)', 'BeneficiosController::actualizarBeneficio/$1');
$routes->get('/admin/beneficios/eliminar/(:num)', 'BeneficiosController::eliminarBeneficio/$1');

$routes->get('/admin/participantes', 'ParticipanteController::participantes');
$routes->get('/admin/participantes/nuevo', 'ParticipanteController::nuevoParticipante');
$routes->post('/admin/participantes/guardar', 'ParticipanteController::guardarParticipante');
$routes->get('/admin/participantes/editar/(:num)', 'ParticipanteController::editarParticipante/$1');
$routes->post('/admin/participantes/actualizar/(:num)', 'ParticipanteController::actualizarParticipante/$1');
$routes->get('/admin/participantes/eliminar/(:num)', 'ParticipanteController::eliminarParticipante/$1');
$routes->post('/admin/participantes/importar', 'ParticipanteController::importarExcel');


$routes->get('/admin/multimedia', 'MultimediaController::multimedia');
$routes->get('/admin/multimedia/nuevo', 'MultimediaController::nuevoMultimedia');
$routes->post('/admin/multimedia/guardar', 'MultimediaController::guardarMultimedia');
$routes->get('/admin/multimedia/editar/(:num)', 'MultimediaController::editarMultimedia/$1');
$routes->post('/admin/multimedia/actualizar/(:num)', 'MultimediaController::actualizarMultimedia/$1');
$routes->get('/admin/multimedia/eliminar/(:num)', 'MultimediaController::eliminarMultimedia/$1');



$routes->group("/admin/usuarios", ["cors:default"], function ($routes) {
    $routes->get('/', 'UsuarioController::usuarios');
    $routes->get('/nuevo', 'UsuarioController::nuevoUsuario');
    $routes->post('/guardar', 'UsuarioController::guardarUsuario');
    $routes->get('/editar/(:num)', 'UsuarioController::editarUsuario/$1');
    $routes->post('/actualizar/(:num)', 'UsuarioController::actualizarUsuario/$1');
    $routes->get('/eliminar/(:num)', 'UsuarioController::eliminarUsuario/$1');
});

$routes->get('/admin/sorteos', 'SorteoController::index'); // Listar sorteos
$routes->get('/admin/sorteos/nuevo', 'SorteoController::nuevo'); // Formulario para crear un nuevo sorteo

$routes->post('/admin/sorteos/realizar', 'SorteoController::realizarSorteo');
$routes->post('/admin/sorteos/guardar', 'SorteoController::guardarSorteo'); // Guardar un nuevo sorteo


$routes->group("/admin/ganadores", ["cors:default"], function ($routes) {
    $routes->get('/', 'GanadoresController::index');
});
