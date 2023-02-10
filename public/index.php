<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIProyectos;
use MVC\Router;
use Controllers\AuthController;
use Controllers\ConfiguracionController;
use Controllers\DashboardController;
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\ProyectosController;

$router = new Router();

// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvidé mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Reestablecer password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

// Area de administracion
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

$router->get('/admin/proyectos', [ProyectosController::class, 'index']);
$router->get('/admin/proyectos/crear', [ProyectosController::class, 'crear']);
$router->post('/admin/proyectos/crear', [ProyectosController::class, 'crear']);
$router->get('/admin/proyectos/editar', [ProyectosController::class, 'editar']);
$router->post('/admin/proyectos/editar', [ProyectosController::class, 'editar']);
$router->post('/admin/proyectos/estatus', [ProyectosController::class, 'estatus']);

$router->get('/admin/configuracion', [ConfiguracionController::class, 'index']);
$router->get('/admin/configuracion/editar', [ConfiguracionController::class, 'editar']);
$router->post('/admin/configuracion/editar', [ConfiguracionController::class, 'editar']);

// APIs
$router->get('/api/proyectos', [APIProyectos::class, 'proyectos']);
$router->post('/api/proyectos', [APIProyectos::class, 'proyectos']);

// Area pública
$router->get('/', [PaginasController::class, 'index']);
$router->post('/', [PaginasController::class, 'index']);
$router->get('/proyectos', [PaginasController::class, 'proyectos']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();