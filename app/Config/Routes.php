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

$routes->group("/admin/premios", ["filter" => "auth", "cors:default"], function ($routes) {
    $routes->get('', 'PremiosController::premios');
    $routes->get('/nuevo', 'PremiosController::nuevoPremio');
    $routes->post('/guardar', 'PremiosController::guardarPremio');
    $routes->get('/editar/(:num)', 'PremiosController::editarPremio/$1');
    $routes->post('/actualizar/(:num)', 'PremiosController::actualizarPremio/$1');
    $routes->get('/eliminar/(:num)', 'PremiosController::eliminarPremio/$1');
});

$routes->group("/admin/beneficios", ["filter" => "auth", "cors:default"], function ($routes) {
    $routes->get('/', 'BeneficiosController::beneficios');
    $routes->get('/nuevo', 'BeneficiosController::nuevoBeneficio');
    $routes->post('/guardar', 'BeneficiosController::guardarBeneficio');
    $routes->get('/editar/(:num)', 'BeneficiosController::editarBeneficio/$1');
    $routes->post('/actualizar/(:num)', 'BeneficiosController::actualizarBeneficio/$1');
    $routes->get('/eliminar/(:num)', 'BeneficiosController::eliminarBeneficio/$1');
});

$routes->group("/admin/participantes", ["filter" => "auth", "cors:default"], function ($routes) {
    $routes->get('/', 'ParticipanteController::participantes');
    $routes->get('/nuevo', 'ParticipanteController::nuevoParticipante');
    $routes->post('/guardar', 'ParticipanteController::guardarParticipante');
    $routes->get('/editar/(:num)', 'ParticipanteController::editarParticipante/$1');
    $routes->post('/actualizar/(:num)', 'ParticipanteController::actualizarParticipante/$1');
    $routes->get('/eliminar/(:num)', 'ParticipanteController::eliminarParticipante/$1');
    $routes->post('/importar', 'ParticipanteController::importarExcel');
});

$routes->group("/admin/multimedia", ["filter" => "auth", "cors:default"], function ($routes) {
    $routes->get('/', 'MultimediaController::multimedia');
    $routes->get('/nuevo', 'MultimediaController::nuevoMultimedia');
    $routes->post('/guardar', 'MultimediaController::guardarMultimedia');
    $routes->get('/editar/(:num)', 'MultimediaController::editarMultimedia/$1');
    $routes->post('/actualizar/(:num)', 'MultimediaController::actualizarMultimedia/$1');
    $routes->get('/eliminar/(:num)', 'MultimediaController::eliminarMultimedia/$1');
});

$routes->group("/admin/usuarios", ["filter" => "auth", "cors:default"], function ($routes) {
    $routes->get('/', 'UsuarioController::usuarios');
    $routes->get('/nuevo', 'UsuarioController::nuevoUsuario');
    $routes->post('/guardar', 'UsuarioController::guardarUsuario');
    $routes->get('/editar/(:num)', 'UsuarioController::editarUsuario/$1');
    $routes->post('/actualizar/(:num)', 'UsuarioController::actualizarUsuario/$1');
    $routes->get('/eliminar/(:num)', 'UsuarioController::eliminarUsuario/$1');
});

$routes->group("/admin/sorteos", ["filter" => "auth", "cors:default"], function ($routes) {
    $routes->get('/', 'SorteoController::index'); // Listar sorteos
    $routes->get('/nuevo', 'SorteoController::nuevo'); // Formulario para crear un nuevo sorteo
    $routes->post('/realizar', 'SorteoController::realizarSorteo');
    $routes->post('/guardar', 'SorteoController::guardarSorteo'); // Guardar un nuevo sorteo
});

$routes->group("/admin/ganadores", ["cors:default"], function ($routes) {
    $routes->get('/', 'GanadoresController::index');
});
